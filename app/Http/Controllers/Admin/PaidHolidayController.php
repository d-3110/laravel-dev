<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaidHoliday;
use Carbon\Carbon;

class PaidHolidayController extends Controller
{
    /**
     * 有給申請一覧画面
     *
     * @param  int  $year $month $day
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 今日の日付を取得
        $today = Carbon::parse('now')->format('Y-m-d');

        // 有給申請中を取得
        $holidays = PaidHoliday::where('status', 1)
                                     ->get();
        return view('admin.paid_holidays.index', compact('holidays'));
    }

    /**
     * 有給承認
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function app(Request $request, $id)
    {
        // 対象の有給レコードを更新する
        $holiday = PaidHoliday::find($id);
        // 未使用に戻す
        $holiday->status = 2;
        $holiday->save();
        return redirect()->route('admin.holidays.index');
    }

    /**
     * 申請取り消し
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
        return redirect()->route('admin.holidays.index');
    }
}
