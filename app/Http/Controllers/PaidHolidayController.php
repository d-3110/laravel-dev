<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaidHoliday;
use Carbon\Carbon;

class PaidHolidayController extends Controller
{
    public function __construct()
    {
        // ログインインユーザ取得
        $this->middleware('login_user');
    }

    /**
     * 有給一覧画面
     *
     * @param  int  $year $month $day
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user->id;
        // 今日の日付を取得
        $today = Carbon::parse('now')->format('Y-m-d');
        // 有給の残日数を取得
        $holidays = PaidHoliday::where('user_id', $user_id)
                               ->where('expire_date', '>', $today)
                               ->Where('status', '<', 2)
                               ->orderBy('expire_date')
                               ->get();
        // 有給申請中を取得
        $app_count = PaidHoliday::where('status', 1)
                                     ->get()
                                     ->count();
        $count = $holidays->count();
        return view('paid_holidays.index', compact('holidays', 'count', 'app_count'));
    }

    /**
     * 有給申請
     *
     * @return \Illuminate\Http\Response
     */
    public function app(Request $request)
    {   
        // 今日の日付を取得
        $today = Carbon::parse('now')->format('Y-m-d');
        return view('paid_holidays.app', ['today' => $today]);
    }

    /**
     * 有給申請を反映
     * use_dateとstatusを更新
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'use_date' => 'required|date_format:"Y-m-d"|unique:paid_holidays',
            'comment'  => 'required|string',
        ]);

        // 今日の日付を取得
        $today = Carbon::parse('now')->format('Y-m-d');
        $user_id = $request->user->id;
        // 一番有効期限が古い有給のIDを取得
        $id = PaidHoliday::where('user_id', $user_id)
                             ->where('expire_date', '>', $today)
                             ->whereNull('use_date')
                             ->orderBy('expire_date', 'asc')
                             ->first()->id;

        // 対象の有給レコードを更新する
        $holiday = PaidHoliday::find($id);
        $holiday->use_date = $request->use_date;
        $holiday->application_date = $today;
        $holiday->comment = $request->comment;
        // 申請中に変更
        $holiday->status = 1;
        $holiday->save();
        return redirect()->route('holidays.index');
    }

    /**
     * 有給申請を取り消す
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, $id)
    {
        // 対象の有給レコードを更新する
        $holiday = PaidHoliday::find($id);
        // 未使用に戻す
        $holiday->status = 0;
        $holiday->use_date = null;
        $holiday->comment = null;
        $holiday->save();
        return redirect()->route('holidays.index');
    }
}
