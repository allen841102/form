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
    return view('welcome');
});

Route::get('s/{id}', 'Frontend\SurveyController@show');
//使用者回覆survey
Route::post('post', 'Frontend\SurveyController@post');
//建立 authentication 註冊 登入 忘記密碼 等 routes
Auth::routes();
//GET 登入後首頁
Route::get('admin/dashboard', 'HomeController@index')->name('dashboard');
Route::prefix('admin/survey')
     ->middleware('auth')
     ->group(function () {
         //GET 建立 Survey 頁面
         Route::get('create', 'SurveyController@create')
              ->name('survey.create');
         //POST 建立 Survey 資料
         Route::post('create', 'SurveyController@store');
         //GET 顯示 Survey details
         Route::get('{id}', 'SurveyController@show');
         //GET 顯示 Survey 編輯資料
         Route::get('edit/{id}', 'SurveyController@edit');
         //PUT 更新 Survey 資料
         Route::put('{id}', 'SurveyController@update');

         Route::delete('{id}', 'SurveyController@destroy');
     });
