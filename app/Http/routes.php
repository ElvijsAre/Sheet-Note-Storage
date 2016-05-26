<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Authentication Routes

Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes

Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', 'Auth\AuthController@postRegister');

// Password Reset Routes

Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

// Pages Routes

Route::get('forum/{slug}', ['as' => 'forum.single', 'uses' => 'ForumController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('forum', ['uses' => 'ForumController@getIndex', 'as' => 'forum.index']);
Route::get('/', 'PagesController@getIndex');
Route::get('/about', 'PagesController@getAbout');
Route::get('music/sheets/{sheets}/upload', ['as' => 'music_sheets.upload', 'uses' => 'Sheet_musicController@getUpload']);
Route::post('music/sheets/{sheets}/upload', 'Sheet_musicController@postUpload');
// Reosurce Routes

Route::resource('posts','PostController');
Route::resource('comments','CommentController');
Route::resource('messages','MessageController');
Route::resource('music/authors','Music_authorController');
Route::resource('music/categories','Music_categoriesController');
Route::resource('music/sheets','Sheet_musicController');

// Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function()
{
	Route::resource('admin','AdminController');
});
