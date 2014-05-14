<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return View::make('index');	
});

// Login routes
Route::post('login', array('uses' => 'UsersController@login'));
Route::get('logout', array('uses' => 'UsersController@logout'));
Route::get('login', array('uses' => 'UsersController@showLogin'));

Route::group(array('before' => 'auth'), function(){
	Route::get('/uploader', function(){
		return View::make('uploader');	
	});
	Route::get('/users', function(){
		return View::make('users.index');	
	});
	Route::group(array('prefix' => 'api'), function(){
	// Route ressource. Kan tilgås ved /api/users
		Route::resource('users', 'UsersController');
		Route::resource('images', 'UploadController');
	});
});
