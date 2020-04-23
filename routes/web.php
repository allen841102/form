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

Route::get('admin/dashboard', 'HomeController@index')->name('dashboard');

Route::get('admin/survey/create', 'SurveyController@create')->name('survey.create');

Route::post('admin/survey/create', 'SurveyController@store');

Route::get('admin/survey/{id}', 'SurveyController@show');

Route::get('admin/survey/edit/{id}', 'SurveyController@edit');

Route::put('admin/survey/{id}', 'SurveyController@update');
