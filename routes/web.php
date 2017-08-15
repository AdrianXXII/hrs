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
    Route::get('/admin', function() {
        echo "<h1>TODO: NAVIGATION PANEL</h1>";
    });
    Route::get('/admin/hotels', 'AdminHotelsController@index')->name('admin.hotels.index');
    Route::get('/admin/hotels/new', 'AdminHotelsController@create')->name('admin.hotels.create');
    Route::get('admin/hotels/{hotel}/edit','AdminHotelsController@edit')->name('admin.hotels.edit');
    Route::put('admin/hotels/{hotel}','AdminHotelsController@update')->name('admin.hotels.update');
    Route::delete('admin/hotels/{hotel}','AdminHotelsController@destroy')->name('admin.hotels.delete');
    Route::post('/admin/hotels', 'AdminHotelsController@store')->name('admin.hotels.save');

    Route::get('/admin/attributes', 'AttributesHotelsController@index')->name('admin.attributes.index');
    Route::get('/admin/attributes/new', 'AttributesHotelsController@create')->name('admin.attributes.create');
    Route::get('admin/attributes/{attribute}/edit','AttributesHotelsController@edit')->name('admin.attributes.edit');
    Route::put('admin/attributes/{attribute}','AttributesHotelsController@update')->name('admin.attributes.update');
    Route::delete('admin/attributes/{attribute}','AttributesHotelsController@destroy')->name('admin.attributes.delete');
    Route::post('/admin/attributes', 'AttributesHotelsController@store')->name('admin.attributes.save');
});

Route::group(['middleware' => 'manager'], function() {
    Route::get('/manager', function() {
       echo "<h1>TODO: NAVIGATION PANEL</h1>";
    });
    Route::get('/manager/hotels', 'ManageHotelsController@index')->name('manager.hotels.index');
    Route::get('manager/hotels/{hotel}/edit','ManageHotelsController@edit')->name('manager.hotels.edit');
    Route::put('manager/hotels/{hotel}','ManageHotelsController@update')->name('manager.hotels.update');
});

Auth::routes();

