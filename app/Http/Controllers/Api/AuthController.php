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
            return response()->json(['error' => 'Unauthorized'], 401);
        }
 
        return $this->respondWithToken($token);
    }
 
    // 自身のユーザデータを取得
    public function me()
    {
        $user = auth($this->guard)->user()->profile;
        $exit_record = AttendanceRecord::todayExistsRecord($user['id']);

        // 必要な情報のみにする
        $result = ['user_id' => $user['id'],
                   'name'    => $user['name'],
                   'exit_record' => $exit_record
                  ];
        return response()->json($result);
    }

    // 勤怠保存
    public function store()
    {


        $user = auth($this->guard)->user();
        $user_id = $user['id'];
        
        $exits = AttendanceRecord::todayExistsRecord($user_id);
        if ($exits) {
            return response()->json(['message' => 'すでに退勤しています。']);
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

        return response()->json(['success' => $result]);
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
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ]);
    }
}
