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