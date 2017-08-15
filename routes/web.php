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

Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin/hotels', 'AdminHotelsController@index')->name('admin.hotels.index');
    Route::get('/admin/hotels/new', 'AdminHotelsController@create')->name('admin.hotels.create');
    Route::get('admin/hotels/{id}/edit','AdminHotelsController@edit')->name('admin.hotels.edit');
    Route::put('admin/hotels/{id}','AdminHotelsController@update')->name('admin.hotels.update');
    Route::delete('admin/hotels/{id}','AdminHotelsController@destroy')->name('admin.hotels.delete');
    Route::post('/admin/hotels', 'AdminHotelsController@store')->name('admin.hotels.save');
});

Auth::routes();

