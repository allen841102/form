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
    $name = request('name');

    return view('welcome', [
    'name' => $name]);
});

Route::get('form/{id}', 'FormController@show')->name('form.show');

Auth::routes();

//GET 登入後首頁
Route::get('admin/dashboard', 'HomeController@index')->name('dashboard');

//GET 建立 Survey 頁面
Route::get('admin/survey/create', 'SurveyController@create')
     ->name('survey.create');

//POST 建立 Survey 資料
Route::post('admin/survey/create', 'SurveyController@store');

//GET 顯示 Survey details
Route::get('admin/survey/{id}', 'SurveyController@show');

//GET 顯示 Survey 編輯資料
Route::get('admin/survey/edit/{id}', 'SurveyController@edit');

//PUT 更新 Survey 資料
Route::put('admin/survey/{id}', 'SurveyController@update');
