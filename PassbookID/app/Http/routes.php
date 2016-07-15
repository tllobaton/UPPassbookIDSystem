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
		return Redirect::to('/Landing');
	}
	return redirect('/login');
});

Route::get(
    'barcode/img/{text}/{size?}/{scale?}/{codeType?}/{orientation?}',
    
    function ($text, $size = 50, $scale = 1, $codeType = 'code128', $orientation = 'horizontal') {
        
        $barcode = new \PicoPrime\BarcodeGen\BarcodeGenerator();

        return $barcode
            ->generate(compact('text', 'size', 'orientation', 'codeType', 'scale'))
            ->response('png');
    }
);
Route::get('/UPVemp', function(){
	return view('UPVemp');
});
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::group(['middleware' => 'auth'], function () {

Route::get('/Details/{type?}', 'CreateIdController@showCreateIdDetails');

Route::get('/Contacts/{type?}', 'CreateIdController@showCreateContacts');

Route::get('/ViewEmergency/{type?}', 'CreateIdController@showEmergencyDetails');		//first back_of_id format; contains person to contact

Route::get('/ViewEmergency1', 'CreateIdController@showEmergencyDetails1');		//second format; contains person to contact as well as barcode

Route::get('/ViewEmergency2', 'CreateIdController@showEmergencyDetails2');		//third format for admin

Route::get('/EmpDetails', 'CreateIdController@showCreateEmpDetails');

Route::any('/Landing', 'CreateIdController@showLandingPage');
Route::post('/FirstLanding', 'CreateIdController@FirstTimeLogin');

Route::post('/Branch', 'CreateIdController@createIdBranch');

Route::get('/ViewId/{type?}', 'CreateIdController@viewId');

Route::get('/AdminView', 'AdminController@index');
Route::get('/AdminViewStud', 'AdminController@s_index');
Route::get('/AdminViewEmp', 'AdminController@e_index');

Route::get('/AdminCreate', 'AdminController@showPromoteView');
Route::get('/AdminRemove', 'AdminController@showRevokeView');

Route::get('/AdminExpire', 'AdminController@showIdExpire');
Route::post('/AdminExpire', 'AdminController@setIdExpire');

Route::get('/AdminCampDept', 'AdminController@showCampDept');
Route::post('/AdminCampDept', 'AdminController@addCampDeptBranch');

Route::get('/AdminAddUsers', 'AdminController@showAddUsers');
Route::post('/AdminAddUsers', 'AdminController@AddUsers');

Route::post('/AdminActDeactUsers', 'AdminController@AddDeactBranch');

Route::get('/AdminDeleteUsers', 'AdminController@showDeleteUsers');
Route::get('/SearchUser1', 'AdminController@search1');

Route::post('/CreateId', 'CreateIdController@createId');

Route::post('/PromoteUser', 'AdminController@createAdmin');
Route::get('/SearchUser', 'AdminController@search');

Route::post('/RemoveAdmin', 'AdminController@removeAdmin');
Route::get('/SearchAdmin', 'AdminController@search_revoke');

Route::any('/Include', 'CreateIdController@test');

Route::any('/MakePass/{type?}', 'CreateIdController@makePass');


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