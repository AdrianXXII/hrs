<?php

Route::get('/', function () {
    return redirect()->route('hotels.index');
})->name("home");

Route::get('/test', function() {
   return view('test');
});

Route::get('/hotels', 'HotelsController@index')->name("hotels.index");
Route::get('/hotels/{hotel}', 'HotelsController@show')->name("hotels.show");
Route::post('/hotels/{hotel}/review', 'ReviewController@store')->name('review.save');
Route::get('/hotels/{hotel}/room/{roomtype}/reserve','GuestReservationController@create')->name('reserve.create');
Route::post('/hotels/{hotel}/room/{roomtype}/reserve','GuestReservationController@store')->name('reserve.save');
Route::get('/search/{startDatum}/{endDatum}','SearchController@search')->name('search');

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
        Route::get('/backend/categories', 'CategoriesController@index')->name('backend.categories.index');
        Route::get('/backend/categories/new', 'CategoriesController@create')->name('backend.categories.create');
        Route::post('/backend/categories', 'CategoriesController@store')->name('backend.categories.save');
        Route::get('/backend/categories/{category}/edit','CategoriesController@edit')->name('backend.categories.edit');
        Route::put('/backend/categories/{category}','CategoriesController@update')->name('backend.categories.update');
        Route::delete('/backend/categories/{category}','CategoriesController@destroy')->name('backend.categories.delete');
    });

    Route::group(['middleware' => 'manager'], function() {
        // Hotels
        Route::get('/manager/hotels', 'ManageHotelsController@index')->name('manager.hotels.index');
        Route::get('manager/hotels/{hotel}/edit','ManageHotelsController@edit')->name('manager.hotels.edit');
        Route::put('manager/hotels/{hotel}','ManageHotelsController@update')->name('manager.hotels.update');

        // RoomType
        Route::get('/manager/hotel/{hotel}/roomtypes', 'RoomtypesController@index')->name('manager.roomtypes.index');
        Route::get('/manager/hotel/{hotel}/roomtypes/new', 'RoomtypesController@create')->name('manager.roomtypes.create');
        Route::post('/manager/hotel/{hotel}/roomtypes', 'RoomtypesController@store')->name('manager.roomtypes.save');
        Route::get('/manager/hotel/{hotel}/roomtypes/{roomtype}/edit','RoomtypesController@edit')->name('manager.roomtypes.edit');
        Route::put('/manager/hotel/{hotel}/roomtypes/{roomtype}','RoomtypesController@update')->name('manager.roomtypes.update');
        Route::delete('/manager/hotel/{hotel}/roomtypes/{roomtype}','RoomtypesController@destroy')->name('manager.roomtypes.delete');

        // Room - Hotelangestellte
        Route::get('/manager/hotel/{hotel}/rooms', 'RoomsController@index')->name('manager.rooms.index');
        Route::get('/manager/hotel/{hotel}/rooms/new', 'RoomsController@create')->name('manager.rooms.create');
        Route::post('/manager/hotel/{hotel}/rooms', 'RoomsController@store')->name('manager.rooms.save');
        Route::get('/manager/hotel/{hotel}/rooms/{room}/edit','RoomsController@edit')->name('manager.rooms.edit');
        Route::put('/manager/hotel/{hotel}/rooms/{room}','RoomsController@update')->name('manager.rooms.update');
        Route::delete('/manager/hotel/{hotel}/rooms/{room}','RoomsController@destroy')->name('manager.rooms.delete');

        //User
        Route::get('/manager/users', 'UserManagerController@index')->name('manager.users.index');
        Route::get('/manager/users/new','UserManagerController@create')->name('manager.users.create');
        Route::get('/manager/users/{user}/edit','UserManagerController@edit')->name('manager.users.edit');
        Route::put('/manager/users/{user}','UserManagerController@update')->name('manager.users.update');
        Route::delete('/manager/users/{user}','UserManagerController@destroy')->name('manager.users.delete');
        Route::post('/manager/users','UserManagerController@store')->name('manager.users.save');

        // Reservationen
        Route::get('/manager/reservations', 'ReservationController@index')->name('manager.reservations.index');
        Route::get('/manager/reservations/new','ReservationController@create')->name('manager.reservations.create');
        Route::get('/manager/reservations/{reservation}/edit','ReservationController@edit')->name('manager.reservations.edit');
        Route::put('/manager/reservations/{reservation}','ReservationController@update')->name('manager.reservations.update');
        Route::delete('/manager/reservations/{reservation}','ReservationController@destroy')->name('manager.reservations.delete');
        Route::post('/manager/reservations','ReservationController@store')->name('manager.reservations.save');

        // Reviews
        Route::get('/manager/hotel/{hotel}/reviews', 'ManagerReviewController@index')->name('manager.reviews.index');
        Route::delete('/manager/hotel/{hotel}/reviews/{review}', 'ManagerReviewController@destroy')->name('manager.reviews.delete');

        // Newsletter
        Route::get('/manger/newsletter', 'NewsletterController@create')->name('manager.newsletter.create');
        Route::post('/manger/newsletter', 'NewsletterController@send')->name('manager.newsletter.send');

        // Statistik
        Route::get('/manager/statistic', 'StatisticController@index')->name('manager.statistic.index');
    });
});

Auth::routes();

