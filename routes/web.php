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


Route::get('create', 'FormController@create');

Route::post('form', 'FormController@store');

Route::get('form/{id}', 'FormController@show')->name('form.show');

Route::get('form', 'FormController@index');

Route::get('json', 'FormController@format');
