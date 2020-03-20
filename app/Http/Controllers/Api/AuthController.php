<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Profile;
use App\AttendanceRecord;
use Carbon\Carbon;
 
class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = 'api';
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth($this->guard)->attempt($credentials)) {
            return response()->json(['success' => true, 'message' => '認証に失敗しました'],401,[],JSON_UNESCAPED_UNICODE);
        }
 
        return $this->respondWithToken($token);
    }
 
    // 自身のユーザデータを取得
    public function me()
    {
        return response()->json(auth($this->guard)->user());
    }

    // 勤怠保存
    public function store()
    {
        $user = auth($this->guard)->user();
        $user_id = $user['id'];
        
        $exits = AttendanceRecord::todayExistsRecord($user_id);
        if ($exits) {
            return response()->json(['success' => false, 'message' => '今日はすでに退勤しています'],200,[],JSON_UNESCAPED_UNICODE);
        }

        $date = Carbon::today()->format('Y-m-d');
        $start_time = request('start_time');
        $end_time = request('end_time');
        $break_time = '01:00';

        // 15分ごとに切り捨てをした時刻と実働時間を取得
        list($actual, $start_time, $end_time) = AttendanceRecord::roundWorkTime($start_time, $end_time , $break_time);
        
        // insertカラム設定
        $record = new AttendanceRecord;
        $record->date = $date;
        $record->start_time = $start_time;
        $record->break_time = $break_time;
        $record->end_time = $end_time;
        $record->user_id = $user_id;
        $record->actual = $actual;
        $result = $record->save();

        // save失敗
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'DBへの保存に失敗しました'],200,[],JSON_UNESCAPED_UNICODE);
        }
        // save成功
        return response()->json(['success' => true, 'message' => 'お疲れ様でした'],200,[],JSON_UNESCAPED_UNICODE);
    }
 
    public function logout()
    {
        auth($this->guard)->logout();
 
        return response()->json(['message' => 'Successfully logged out']);
    }
 
    public function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
    }
 
    protected function respondWithToken($token)
    {
        $user = auth($this->guard)->user()->profile;
        $exits = AttendanceRecord::todayExistsRecord($user['id']);

        // 必要な情報のみにする
        $user = ['id' => $user['id'],
                 'name' => $user['name'],
                ];

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60,
            'success' => true,
            'user' => $user,
            'exits' => $exits
        ],200,[],JSON_UNESCAPED_UNICODE)->header('Content-Type', 'text/html; charset=utf8');
    }
}
