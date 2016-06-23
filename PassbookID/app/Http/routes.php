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
	if (Auth::check()){
		return Redirect::to('/Details');
	}
	return redirect('/login');
});

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::group(['middleware' => 'auth'], function () {

Route::get('/Details/{type?}', 'CreateIdController@showCreateIdDetails');

Route::get('/Contacts', 'CreateIdController@showCreateContacts');

Route::get('/EmpDetails', 'CreateIdController@showCreateEmpDetails');

Route::get('/Landing', 'CreateIdController@showLandingPage');

Route::post('/Branch', 'CreateIdController@createIdBranch');

Route::get('/AdminView', 'AdminController@index');

Route::get('/AdminCreate', 'AdminController@showPromoteView');

Route::post('/CreateId', 'CreateIdController@createId');
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
Route::get('/UPOU', function(){
	return view('UPOU');
});
Route::get('/UPOU_admin', function(){
	return view('UPOU_admin');
});

});