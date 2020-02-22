<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRecordValidateRequest;
use App\AttendanceRecord;
use App\Profile;
use App\User;
use Carbon\Carbon;

class AttendanceRecordController extends Controller
{
    /**
     * 月別勤怠時間集計
     *
     * @param  int  $year $month $day
     * @return \Illuminate\Http\Response
     */
    public function aggregate($year = '', $month = '', $day = '')
    {
        // デフォルト値を現在日付で設定
        $year = $year ?: Carbon::today()->year;
        $month = $month ?: Carbon::today()->month;
        $day = $day ?: Carbon::today()->day;
        
        $current_date = compact('year', 'month', 'day');

        // 現在日付取得
        $today = Carbon::parse($year.'-'.$month.'-'.$day)->format('Y-m-d');
        
        // 勤怠情報を取得
        $users = User::select('users.id', 'profiles.name', DB::raw('SUM(actual) as total'))
                         ->join('attendance_records', 
                                'attendance_records.user_id', '=', 'users.id')
                         ->join('profiles', 
                                'profiles.user_id', '=', 'users.id')
                         ->whereYear('date', $year)
                         ->whereMonth('date', $month)
                         ->groupBy('users.id', 'profiles.name')
                         ->get();

        // 前月/次月を作成する
        list($prev_date, $next_date) = AttendanceRecord::makePrevAndNext($year, $month);

        // 月合計を作成
        $total = 0;
        foreach ($users as $key => $user) {
            $total += $user->total;
        }

        return view('admin.attendance_records.aggregate', compact('current_date', 'prev_date', 'next_date', 'total', 'users'));
    }
}