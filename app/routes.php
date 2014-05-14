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
Route::get('/uploader', function(){
	return View::make('uploader');	
});
Route::get('/', function(){
	return View::make('index');	
});

Route::group(array('prefix' => 'api'), function(){
	// Route ressource. Kan tilgås ved /api/users
	Route::resource('images', 'UploadController');
});

Route::post('api/images', array('uses' => 'UploadController@save'));
// Route::get('api/images', array('uses' => 'UploadController@index'));
// Route::delete('api/images/(:num)', array('uses' => 'UploadController@destroy'));

// Route::group(array('prefix' => 'api'), function(){
// 	// Route ressource. Kan tilgås ved /api/users
// 	Route::resource('images', 'UploadController');
// });