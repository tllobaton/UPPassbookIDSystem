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

Route::group(['middleware' => 'web'], function () {
    Route::auth();
	Route::get('/', function () {
		return view('auth\login');
	});
	Route::get('/form', function(){
		return view('create_id');
	});
	Route::get('/UPV', function(){
		return view('UPV');
	});
	Route::get('/UPD', function(){
		return view('UPD');
	});
	Route::get('/UPB', function(){
		return view('UPB');
	});
	Route::get('/UPM', function(){
		return view('UPM');
	});
	Route::get('/test', function(){
		return view('test');
	});
});

Route::get('admin','StudViewController@index');