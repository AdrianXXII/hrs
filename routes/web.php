<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('hotels', 'HotelsController@index');
Route::get('hotels/{hotel}', 'HotelsController@show');
Route::get('hotels/create', 'HotelsController@create');
Route::post('hotels', 'HotelsController@store');