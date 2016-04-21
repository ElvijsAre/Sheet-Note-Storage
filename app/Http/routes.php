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
Route::get('forum/{slug}', ['as' => 'forum.single', 'uses' => 'ForumController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('forum', ['uses' => 'ForumController@getIndex', 'as' => 'forum.index']);
Route::get('/', 'PagesController@getIndex');
Route::get('/about', 'PagesController@getAbout');
Route::resource('posts','PostController');
