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
  return redirect('login/');
});



// 一般ユーザ
Route::group(['middleware' => ['auth', 'can:all-user']], function () {
  // ユーザ一覧
  Route::get('/users', 'UserController@index')->name('users.index');
  Route::get('users/profiles/{id}', 'ProfileController@show')->name('profiles.show');
  Route::get('/mypage/', 'ProfileController@index')->name('profiles.index');

  // 勤怠一覧(月ごと)
  Route::get('/work_time/list/{year?}/{month?}/{day?}', 'AttendanceRecordController@index')->name('records.index');
  
  // 勤怠登録
  Route::get('/work_time/create/{year?}/{month?}/{day?}', 'AttendanceRecordController@create')->name('records.create');
  Route::post('/work_time/create', 'AttendanceRecordController@store')->name('records.store');

  // 勤怠編集
  Route::get('/work_time/{id}/edit', 'AttendanceRecordController@edit')->name('records.edit'); 
  Route::match(['PUT','PATCH'], '/work_time/{id}/edit', 'AttendanceRecordController@update')
  ->name('records.update');

  // 勤怠削除
  Route::post('/work_time/{id}/delete', 'AttendanceRecordController@destroy')->name('records.destroy');

  // 有給一覧
  Route::get('/holidays', 'PaidHolidayController@index')->name('holidays.index');
  // 有給取り消し
  Route::post('/holidays/{id}/cancel', 'PaidHolidayController@cancel')->name('holidays.cancel');
  // 有給申請
  Route::get('/holidays/app', 'PaidHolidayController@app')->name('holidays.app');
  Route::post('/holidays/app', 'PaidHolidayController@update')->name('holidays.update');

});

/****************************************************************************/


// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-only']], function () {

  // ユーザ一覧
  Route::get('admin/users', 'Admin\UserController@index')->name('admin.users.index');
  // ユーザー絞り込み
  Route::get('admin/users/filter', 'Admin\UserController@filter')->name('admin.users.filter');

  // ユーザ登録
  Route::get('admin/users/create', 'Admin\UserController@create')->name('admin.users.create');
  Route::post('admin/users/create', 'Admin\UserController@store')->name('admin.users.store');

  // ユーザ編集
  Route::get('admin/users/{id}/edit', 'Admin\UserController@edit')->name('admin.users.edit');
  Route::match(['PUT','PATCH'], 'admin/users/{id}/', 'Admin\UserController@update')->name('admin.users.update');

  // ユーザ削除
  Route::post('admin/users/{id}/delete', 'Admin\UserController@destroy')->name('admin.users.destroy');

  // 部署一覧
  Route::get('admin/depts', 'Admin\DeptController@index')->name('admin.depts.index');
  // 部署登録
  Route::get('admin/depts/create', 'Admin\DeptController@create')->name('admin.depts.create');
  Route::post('admin/depts/create', 'Admin\DeptController@store')->name('admin.depts.store');

  // 部署編集
  Route::get('admin/depts/{id}/edit', 'Admin\DeptController@edit')->name('admin.depts.edit');
  Route::match(['PUT','PATCH'], 'admin/depts/{id}/', 'Admin\DeptController@update')->name('admin.depts.update');

  // 部署削除
  Route::post('admin/depts/{id}/delete', 'Admin\DeptController@destroy')->name('admin.depts.destroy');

  // 職種一覧
  Route::get('admin/jobs', 'Admin\JobController@index')->name('admin.jobs.index');
  
  // 職種登録
  Route::get('admin/jobs/create', 'Admin\JobController@create')->name('admin.jobs.create');
  Route::post('admin/jobs/create', 'Admin\JobController@store')->name('admin.jobs.store');

  // 職種編集
  Route::get('admin/jobs/{id}/edit', 'Admin\JobController@edit')->name('admin.jobs.edit');
  Route::match(['PUT','PATCH'], 'admin/jobs/{id}/', 'Admin\JobController@update')->name('admin.jobs.update');

  // 職種削除
  Route::post('admin/jobs/{id}/delete', 'Admin\JobController@destroy')->name('admin.jobs.destroy');

  // 有給承認
  Route::get('admin/holidays/', 'Admin\PaidHolidayController@index')->name('admin.holidays.index');
  Route::post('admin/holidays/{id}/app', 'Admin\PaidHolidayController@app')->name('admin.holidays.app');
  Route::post('admin/holidays/{id}/cancel', 'Admin\PaidHolidayController@cancel')->name('admin.holidays.cancel');

  // 勤怠ユーザ単位集計
  Route::get('admin/work_time/aggregate/{year?}/{month?}/{day?}', 'Admin\AttendanceRecordController@aggregate')->name('admin.record.aggregate');
  // 勤怠一覧・登録・編集・削除は通常会員と同じアクションを使用

  // 勤怠編集
  Route::get('admin/work_time/{id}/edit', 'AttendanceRecordController@edit')->name('records.edit'); 
  Route::match(['PUT','PATCH'], 'admin/work_time/{id}/edit', 'AttendanceRecordController@update')
  ->name('admin.records.update');

  // 勤怠削除
  Route::post('admin/work_time/{id}/delete', 'AttendanceRecordController@destroy')->name('admin.records.destroy');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
