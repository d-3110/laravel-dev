<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AttendanceRecord;
use App\User;
use Carbon\Carbon;

class AttendanceRecordController extends Controller
{
    /**
     * 勤怠一覧画面
     *
     * @param  int  $year $month $day
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $year = '', $month = '', $day = '')
    {
        // デフォルト値を現在日付で設定
        $year = $year ?: Carbon::today()->year;
        $month = $month ?: Carbon::today()->month;
        $day = $day ?: Carbon::today()->day;
        
        $current_date = compact('year', 'month', 'day');

        // 現在日付取得
        $today = Carbon::parse($year.'-'.$month.'-'.$day)->format('Y-m-d');
        
        list($user, $non_self) = User::getUserOrNonSelf($request);
        // 勤怠情報を取得
        $records = AttendanceRecord::where('user_id', $user->id)
                                                  ->whereYear('date', $year)
                                                  ->whereMonth('date', $month)
                                                  ->get();

        // 前月/次月を作成する
        list($prev_date, $next_date) = AttendanceRecord::makePrevAndNext($year, $month);

        // カレンダー配列にする
        $calendar = AttendanceRecord::makeCalendar($records, $year, $month);

        // 月合計を作成
        $total = AttendanceRecord::makeTotal($records);

        return view('attendance_records.index', compact('non_self', 'user', 'current_date', 'prev_date', 'next_date', 'calendar', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $year, $month, $day)
    {
        list($user, $non_self) = User::getUserOrNonSelf($request);
        // ルートパラメータの日付をdate型に変換しておく
        $date = Carbon::createMidnightDate($year, $month, $day)->format('Y-m-d');
        return view('attendance_records.create', compact('non_self', 'user','date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        list($user, $non_self) = User::getUserOrNonSelf($request, 'post');
        $user_id = $user->id;

        $request->validate([
            'date'       => 'required|date_format:"Y-m-d"|unique:attendance_records,date,NULL,user_id,user_id,'.$user_id,
            'start_time' => 'required|date_format:"H:i"',
            'end_time'   => 'required|date_format:"H:i"',
            'break_time' => 'required|date_format:"H:i"',
        ]);

        $actual = AttendanceRecord::workTimeCalc($request);


        // insertカラム設定
        $record = new AttendanceRecord;
        $record->fill($request->all());
        $record->user_id = $user_id;
        $record->actual = $actual;
        $record->save();

        // 他ユーザの勤怠を登録した場合
        if ($non_self) {
            return redirect()->route('records.index', compact('user_id'));
        }
        return redirect()->route('records.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = AttendanceRecord::find($id);
        $current_user = Auth::user();
        // adminユーザでなく、他人の勤怠は編集させない
        if ($record->user_id !== $current_user->id && $current_user->is_admin !== 1) {
            return back();
        }
        return view('attendance_records.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = AttendanceRecord::find($id);
        $actual = AttendanceRecord::workTimeCalc($request);
        $crrent_user = Auth::user();

        $record->fill($request->all());
        $record->actual = $actual;
        $record->save();

        // 他ユーザの勤怠を更新した場合
        if ($record->user_id !== $crrent_user->user_id) {
            $user_id = $record->user_id;
            return redirect()->route('records.index', compact('user_id'));
        }
        return redirect()->route('records.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = AttendanceRecord::find($id);
        $crrent_user = Auth::user();

        $record->delete();

        // 他ユーザの勤怠を削除した場合
        if ($record->user_id !== $crrent_user->user_id) {
            $user_id = $record->user_id;
            return redirect()->route('records.index', compact('user_id'));
        }
        return redirect()->route('records.index');
    }
}
