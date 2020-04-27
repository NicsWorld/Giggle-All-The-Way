<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'JokeController@index')->name('jokes');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/jokes', 'JokeController@store');
Route::get('/jokes/create', 'JokeController@create');
Route::post('/jokes/{id}/act', 'JokeController@actOnChirp');


Route::get('/users/{id}', 'UsersController@user');
