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

<<<<<<< HEAD
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
	Route::get('/UPLB', function(){
		return view('UPLB');
	});
	Route::get('/create', function(){
		return view('admin_create');
	});
	Route::get('/test', function(){
		return view('test');
	});
	Route::get('/admin','StudViewController@index');
});
=======

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
Route::get('/create', function(){
	return view('admin_create');
});
Route::get('/test', function(){
	return view('test');
});


Route::get('admin','StudViewController@index');
>>>>>>> b695ed3b6fc0e46758ea31c42c27dea33a034332
