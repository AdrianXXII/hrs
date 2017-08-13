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
})->name("home");

Route::get('/adminOnly', function () {
    return "Admin Only!";
})->middleware('admin');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/new','UserController@create')->name('users.create');
    Route::get('/users/{id}/edit','UserController@edit')->name('users.edit');
    Route::put('/users/{id}','UserController@update')->name('users.update');
    Route::delete('/users/{id}','UserController@destroy')->name('users.delete');
    Route::post('/users','UserController@store')->name('users.save');
});

Auth::routes();

Route::get('hotels', 'HotelsController@index');
Route::get('hotels/{hotel}', 'HotelsController@show');
Route::get('hotels/create', 'HotelsController@create');
Route::post('hotels', 'HotelsController@store');