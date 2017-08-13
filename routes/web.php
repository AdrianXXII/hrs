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

Route::get('hotels', 'HotelsController@index');
Route::get('hotels/{hotel}', 'HotelsController@show');
Route::get('hotels/create', 'HotelsController@create');
Route::post('hotels', 'HotelsController@store');