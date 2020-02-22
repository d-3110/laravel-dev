<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginUser
{

    public function handle($request, Closure $next)
    {
        // ログインユーザ取得
        $user = Auth::user();
        $request->merge(['user' => $user]);

        return $next($request);
    }
}