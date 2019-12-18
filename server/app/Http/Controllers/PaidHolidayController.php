<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
    }
}
