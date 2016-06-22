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

Route::auth();
Route::get('/', function () {
	return redirect('/login');
});

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::group(['middleware' => 'auth'], function () {

Route::get('/StudentID', 'CreateIdController@showCreateIdDetails');

Route::get('/Contacts', 'CreateIdController@showCreateContacts');

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
Route::get('/AdminCreate', function(){
	return view('AdminCreate');
});


Route::get('/AdminView','AdminController@index');

});