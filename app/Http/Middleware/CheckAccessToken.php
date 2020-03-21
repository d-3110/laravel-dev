<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class CheckAccessToken
{
    /**
     * リクエストのヘッダーのトークンを検証
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $string = $token = JWTAuth::getToken();

        // ヘッダーにAuthorizationが存在するかをチェック
        if ((!$request->header('Authorization'))) {

            return response()->json([
                'error' => Config::get('jwt.headerAuthorizationMissing')
            ],200,[],JSON_UNESCAPED_UNICODE);
        }

        try {
            // トークンに含まれているユーザは存在するかをチェック
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'error' => Config::get('jwt.invalidToken')
                ],200,[],JSON_UNESCAPED_UNICODE);
            }
        } catch (TokenInvalidException $e) {
            // 無効なアクセストークンによるエラー
            return response()->json([
                'error' => Config::get('jwt.invalidAccessToken')
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (TokenExpiredException $e) {
            // アクセストークンの有効期限切れによるエラー
            return response()->json([
                'error' => Config::get('jwt.expiredAccessToken')
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (JWTException $e) {
            // その他の原因によるトークンのエラー
            return response()->json([
                'error' => Config::get('jwt.tokenSomethingWentWrongError')
            ],200,[],JSON_UNESCAPED_UNICODE);
        }
        // コントローラにリクエストを送る
        $response = $next($request);

        return $response;
    }
}