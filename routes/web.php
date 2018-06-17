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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('threads/create', 'ThreadsController@create');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy');
Route::get('threads/{channel}', 'ThreadsController@index');
Route::resource('threads', 'ThreadsController');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store')->name('add_reply_to_thread');
Route::delete('/replies/{reply}', 'RepliesController@destroy');
Route::patch('/replies/{reply}', 'RepliesController@update');

Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('add_favorite_to_reply');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy')->name('unfavorite_a_reply');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
