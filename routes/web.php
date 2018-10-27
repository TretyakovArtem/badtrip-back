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

Route::middleware('jwt.auth')->post('api/projects/create', 'Api\ProjectsControl@create');
Route::middleware('jwt.auth')->post('api/trips/create', 'Api\TripsControl@create');
Route::middleware('jwt.auth')->post('api/projects/comment', 'Api\ProjectsCommentsControl@create');
Route::middleware('jwt.auth')->post('api/trips/comment', 'Api\TripsCommentsControl@create');

Route::get('api/trips/getlist', 'Api\Trips@getlist');
Route::get('api/projects/getlist', 'Api\Projects@getlist');

Route::post('api/login', 'Api\AuthController@login');
Route::post('api/register', 'Auth\RegisterController@create');
Route::post('api/logged', 'Api\AuthController@logged');
