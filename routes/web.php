<?php

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('/hotels', 'HotelsController@index')->name("hotels.index");

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'admin'], function(){
        Route::get('/backend', function() {
            return view('backend.index');
        })->name('backend.index');

        Route::get('/backend/users', 'UserController@index')->name('users.index');
        Route::get('/backend/users/new','UserController@create')->name('users.create');
        Route::get('/backend/users/{user}/edit','UserController@edit')->name('users.edit');
        Route::put('/backend/users/{user}','UserController@update')->name('users.update');
        Route::delete('/backend/users/{user}','UserController@destroy')->name('users.delete');
        Route::post('/backend/users','UserController@store')->name('users.save');

        //Attributes
        Route::get('/backend/attributes', 'AttributeController@index')->name('attributes.index');
        Route::get('/backend/attributes/new','AttributeController@create')->name('attributes.create');
        Route::get('/backend/attributes/{id}/edit','AttributeController@edit')->name('attributes.edit');
        Route::put('/backend/attributes/{id}','AttributeController@update')->name('attributes.update');
        Route::delete('/backend/attributes/{id}','AttributeController@destroy')->name('attributes.delete');
        Route::post('/backend/attributes','AttributeController@store')->name('attributes.save');

        // Hotels
        Route::get('/backend/hotels', 'AdminHotelsController@index')->name('backend.hotels.index');
        Route::get('/backend/hotels/new', 'AdminHotelsController@create')->name('backend.hotels.create');
        Route::post('/backend/hotels', 'AdminHotelsController@store')->name('backend.hotels.save');
        Route::get('/backend/hotels/{hotel}/edit','AdminHotelsController@edit')->name('backend.hotels.edit');
        Route::put('/backend/hotels/{hotel}','AdminHotelsController@update')->name('backend.hotels.update');
        Route::delete('/backend/hotels/{hotel}','AdminHotelsController@destroy')->name('backend.hotels.delete');

        // Categories
        Route::get('/backend/categories', 'AdminCategoriesController@index')->name('backend.categories.index');
        Route::get('/backend/categories/new', 'AdminCategoriesController@create')->name('backend.categories.create');
        Route::post('/backend/categories', 'AdminCategoriesController@store')->name('backend.categories.save');
        Route::get('/backend/categories/{category}/edit','AdminCategoriesController@edit')->name('backend.categories.edit');
        Route::put('/backend/categories/{category}','AdminCategoriesController@update')->name('backend.categories.update');
        Route::delete('/backend/categories/{category}','AdminCategoriesController@destroy')->name('backend.categories.delete');
    });

    Route::group(['middleware' => 'manager'], function() {
        Route::get('/manager/hotels', 'ManageHotelsController@index')->name('manager.hotels.index');
        Route::get('manager/hotels/{hotel}/edit','ManageHotelsController@edit')->name('manager.hotels.edit');
        Route::put('manager/hotels/{hotel}','ManageHotelsController@update')->name('manager.hotels.update');
    });
});

Auth::routes();

