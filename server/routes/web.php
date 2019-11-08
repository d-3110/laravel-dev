<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('test');
    // return view('welcome');
    // return view('top');
  Route::group(['middleware' => ['auth', 'can:admin-only']], function () {
    // ユーザ一覧
    Route::get('admin/users', 'UserController@index')->name('users.index');
  });
});
// Route::resource('users', 'UserController');


// 一般ユーザ
Route::group(['middleware' => ['auth', 'can:all-user']], function () {

});

// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-only']], function () {

  // ユーザ一覧
  Route::get('admin/users', 'UserController@index')->name('users.index');

  // ユーザ登録
  Route::get('admin/users/regist', 'UserController@create')->name('users.create');
  Route::post('admin/users/regist', 'UserController@store')->name('users.store');

  // ユーザ編集
  Route::get('admin/users/{id}/edit', 'UserController@edit')->name('users.edit');
  Route::match(['PUT','PATCH'], 'admin/users/{id}/', 'UserController@update')->name('users.update');

  // ユーザ削除
  Route::post('admin/users/{id}/delete', 'UserController@destroy')->name('users.destroy');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
