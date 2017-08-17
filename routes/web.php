<?php

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'admin'], function(){
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/users/new','UserController@create')->name('users.create');
        Route::get('/users/{id}/edit','UserController@edit')->name('users.edit');
        Route::put('/users/{id}','UserController@update')->name('users.update');
        Route::delete('/users/{id}','UserController@destroy')->name('users.delete');
        Route::post('/users','UserController@store')->name('users.save');

        //Attributes
        Route::get('/attributes', 'AttributeController@index')->name('attributes.index');
        Route::get('/attributes/new','AttributeController@create')->name('attributes.create');
        Route::get('/attributes/{id}/edit','AttributeController@edit')->name('attributes.edit');
        Route::put('/attributes/{id}','AttributeController@update')->name('attributes.update');
        Route::delete('/attributes/{id}','AttributeController@destroy')->name('attributes.delete');
        Route::post('/attributes','AttributeController@store')->name('attributes.save');

        // Hotels
        Route::get('/backend/hotels', 'AdminHotelsController@index')->name('backend.hotels.index');
        Route::get('/backend/hotels/new', 'AdminHotelsController@create')->name('backend.hotels.create');
        Route::get('/backend/hotels/{hotel}/edit','AdminHotelsController@edit')->name('backend.hotels.edit');
        Route::put('/backend/hotels/{hotel}','AdminHotelsController@update')->name('backend.hotels.update');
        Route::delete('/backend/hotels/{hotel}','AdminHotelsController@destroy')->name('backend.hotels.delete');
        Route::post('/backend/hotels', 'AdminHotelsController@store')->name('backend.hotels.save');
    });

    Route::group(['middleware' => 'manager'], function() {
        Route::get('/manager/hotels', 'ManageHotelsController@index')->name('manager.hotels.index');
        Route::get('manager/hotels/{hotel}/edit','ManageHotelsController@edit')->name('manager.hotels.edit');
        Route::put('manager/hotels/{hotel}','ManageHotelsController@update')->name('manager.hotels.update');
    });
});

Auth::routes();

