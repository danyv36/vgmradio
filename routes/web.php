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

Route::get('/', 'SongsController@home')->name('home');
Route::post('/search', 'SongsController@search2')->name('search');
Route::resource('users', 'UsersController');
Route::resource('sessions', 'SessionsController');
Route::resource('likes', 'LikesController');
Route::resource('playlists', 'PlaylistsController');
Route::resource('playlistdetails', 'PlaylistDetailsController');
Route::get('login', 'SessionsController@create')->name('login'); //adding name to check in view if user is logged in
Route::get('logout', 'SessionsController@destroy');

Route::get('admin', function(){
    return 'Admin Page';
});