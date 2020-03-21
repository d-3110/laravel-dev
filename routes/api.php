<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function(){
  Route::resource('profiles', 'Api\ProfileController', ['except' => ['create', 'edit']]);

  // プロフィール画像保存
  Route::post('profiles/fileupload/{profile}', 'Api\ProfileController@fileUpload');
  // ユーザ一覧表示
  Route::get('users/', 'Api\UserController@index');
});

// 認証前もアクセス可能
Route::group(['middleware' => 'guest:api'], function () {
  Route::post('auth/login', 'Api\AuthController@login');
});
// 認証後のみアクセス可能
Route::group(['middleware' => 'auth:api'], function () {
  Route::middleware(['jwt_access'])->group(function () {
    Route::post('auth/me', 'Api\AuthController@me');
    Route::post('auth/logout', 'Api\AuthController@logout');
    Route::post('auth/refresh', 'Api\AuthController@refresh');
    Route::post('auth/store', 'Api\AuthController@store');
  });
});