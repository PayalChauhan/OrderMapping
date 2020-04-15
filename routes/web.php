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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'TestController@index')->name('test');
Route::post('/store', 'TestController@store')->name('store');
Route::post('/storeAjax', 'TestController@storeAjax')->name('storeAjax');
Route::post('/status', 'TestController@status')->name('status');
Route::any('/delete/{id}', 'TestController@delete')->name('delete');


