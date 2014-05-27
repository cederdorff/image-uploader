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

Route::group(array('prefix' => 'pages'), function(){
	Route::get('home', function(){
		return View::make('home');	
	});
	Route::get('paul', function(){
		return View::make('paul');	
	});
});
// Login routes
Route::post('login', array('uses' => 'LoginController@login'));
Route::get('logout', array('uses' => 'LoginController@logout'));
Route::get('login', array('uses' => 'LoginController@index'));

Route::get('images', array('uses' => 'ImagesController@index'));

Route::group(array('before' => 'auth'), function(){
	Route::get('/admin', function(){
		return View::make('admin.index');	
	});
	Route::get('/pages/uploader', function(){
		return View::make('admin.uploader');	
	});
	Route::group(array('before' => 'admin_auth'), function()
	{
		Route::get('/pages/users', function(){
			return View::make('admin.users');	
		});
		Route::group(array('prefix' => 'api'), function(){
			Route::resource('users', 'UsersController');
		});
	});
	Route::group(array('prefix' => 'api'), function(){
		Route::get('users', array('uses' => 'UsersController@index'));
		Route::resource('images', 'UploadController');
	});
});

// CATCH ALL ROUTE
App::missing(function($exception)
{
	return View::make('index');
});
