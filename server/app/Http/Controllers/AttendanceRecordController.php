<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AttendanceRecord;
use App\PaidHoliday;
use Carbon\Carbon;

class AttendanceRecordController extends Controller
{
    /**
     * 勤怠一覧画面
     *
     * @param  int  $year $month $day
     * @return \Illuminate\Http\Response
     */
    public function index($year = '', $month = '', $day = '')
    {
        // デフォルト値を現在日付で設定
        $year = $year ?: Carbon::today()->year;
        $month = $month ?: Carbon::today()->month;
        $day = $day ?: Carbon::today()->day;
        
        // ログインユーザ取得
        $user = Auth::user();
        $user_id = $user->id;

        $current_date = compact('year', 'month', 'day');

        // 現在日付取得
        $today = Carbon::parse($year.'-'.$month.'-'.$day)->format('Y-m-d');
        
        // 勤怠情報を取得
        $records = AttendanceRecord::where('user_id', $user_id)
                                                  ->whereYear('date', $year)
                                                  ->whereMonth('date', $month)
                                                  ->get();
        
        // 前月/次月を作成する
        list($prev_date, $next_date) = AttendanceRecord::makePrevAndNext($year, $month);

        // カレンダー配列にする
        $calendar = AttendanceRecord::makeCalendar($records, $year, $month);

        // 月合計を作成
        $total = AttendanceRecord::makeTotal($records);

        // ログインしているユーザの利用可能な有休日数を取得
        $holiday = PaidHoliday::where('user_id', $user_id)
                                      ->where('expire_date', '>', $today)
                                      ->whereNull('use_date')
                                      ->count('expire_date');

        return view('attendance_records.index', compact('current_date', 'prev_date', 'next_date', 'calendar', 'total', 'holiday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($year, $month, $day)
    {
        // ルートパラメータの日付をdate型に変換しておく
        $date = Carbon::createMidnightDate($year, $month, $day)->format('Y-m-d');
        return view('attendance_records.create', compact('date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'       => 'required|date_format:"Y-m-d"|unique:attendance_records',
            'start_time' => 'required|date_format:"H:i"',
            'end_time'   => 'required|date_format:"H:i"',
            'break_time' => 'required|date_format:"H:i"',
        ]);

        // ログインユーザ取得
        $user = Auth::user();
        $user_id = $user->id;

        // 開始時間から終了時間までの時間を算出
        $start = new Carbon($request->start_time);
        $end = new Carbon($request->end_time);
        $total = $start->diffInMinutes($end) / 60;

        // 休憩時間は00：00から何時間かで算出
        // ex) 00:00 ~ 01:00 = 1h
        $zero = new Carbon('00:00');
        $break = new Carbon($request->break_time);
        $exclusion = $zero->diffInMinutes($break) / 60;

        // insertカラム設定
        $record = new AttendanceRecord;
        $record->fill($request->all());
        $record->user_id = $user_id;
        $record->actual = $total - $exclusion; // 合計時間 - 休憩時間 = 実働時間
        $record->save();

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
        $record->fill($request->all());
        $record->save();
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
        $record->delete();
        return redirect()->route('records.index');
    }
}
