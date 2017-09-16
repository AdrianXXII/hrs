<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/v1/hotel/{hotel}/review', 'ReviewApiController@index');
Route::get('/v1/hotel/{hotel}/review/{review}', 'ReviewApiController@show');
Route::post('/v1/hotel/{hotel}/review', 'ReviewApiController@store');