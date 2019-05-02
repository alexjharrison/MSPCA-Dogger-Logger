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

Route::post('/auth/register', 'Auth\RegisterController@create');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::post('/api/error', 'ErrorController@store');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return  $request->user();
});

Route::middleware('auth:api')->group(function () {

    Route::get('/dogs', 'DogController@fetchAll');
    Route::post('/dog', 'DogController@store');
    Route::put('/dog', 'DogController@update');
    Route::delete('/dog/{dogId}', 'DogController@destroy');

    Route::get('/photo/{photoId}', 'PhotoController@fetchOne');
    Route::post('/photo', 'PhotoController@store');
    Route::delete('/photo/{photoId}', 'PhotoController@destroy');

    Route::get('/walks/{dogId}', 'WalkController@fetchAll');
    Route::post('/walk', 'WalkController@store');
    Route::put('/walk', 'WalkController@update');

    Route::get('/users', 'UserController@fetchAll');
    Route::post('/adminify', 'UserController@adminify');
});
