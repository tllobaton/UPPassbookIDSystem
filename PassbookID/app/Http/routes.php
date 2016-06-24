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

Route::get(
    'barcode/img/{text}/{size?}/{scale?}/{codeType?}/{orientation?}',
    
    function ($text, $size = 35, $scale = 1.15, $codeType = 'code39', $orientation = 'horizontal') {
        
        $barcode = new \PicoPrime\BarcodeGen\BarcodeGenerator();

        return $barcode
            ->generate(compact('text', 'size', 'orientation', 'codeType', 'scale'))
            ->response('png');
    }
);

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::group(['middleware' => 'auth'], function () {

Route::get('/Details/{type?}', 'CreateIdController@showCreateIdDetails');

Route::get('/Contacts/{type?}', 'CreateIdController@showCreateContacts');

Route::get('/ViewEmergency', 'ViewInfoController@showEmergencyDetails');		//first back_of_id format; contains person to contact

Route::get('/ViewEmergency1', 'ViewInfoController@showEmergencyDetails1');		//second format; contains person to contact as well as barcode

Route::get('/ViewEmergency2', 'ViewInfoController@showEmergencyDetails2');		//third format for admin

Route::get('/EmpDetails', 'CreateIdController@showCreateEmpDetails');

Route::get('/Landing', 'CreateIdController@showLandingPage');

Route::post('/Branch', 'CreateIdController@createIdBranch');

Route::get('/AdminView', 'AdminController@index');

Route::get('/AdminCreate', 'AdminController@showPromoteView');

Route::post('/CreateId', 'CreateIdController@createId');

Route::post('/PromoteUser', 'AdminController@createAdmin');
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