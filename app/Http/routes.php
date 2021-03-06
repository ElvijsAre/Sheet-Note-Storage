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
Route::get('/download/{file}', 'Sheet_musicController@download');

// Profile Routes

Route::get('/profile/{user}', ['as' => 'profile', 'uses' => 'ProfileController@getShow']);
Route::get('/profile/{user}/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@getEdit']);
Route::put('/profile/{user}', ['as' => 'profile.update', 'uses' => 'ProfileController@postUpdate']);

// Reosurce Routes

Route::resource('posts','PostController');
Route::resource('comments','CommentController');
Route::resource('categories','CategoriesController');
Route::resource('messages','MessageController');
Route::resource('music/authors','Music_authorController');
Route::resource('music/categories','Music_categoriesController');
Route::resource('music/sheets','Sheet_musicController');
Route::resource('music/orchestrations','Music_orchestrationController');

// Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function()
{
	Route::resource('admin','AdminController');
});
