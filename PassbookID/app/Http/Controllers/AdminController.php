<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use DB;

class AdminController extends Controller
{
    public function index(){
		$users = DB::select('SELECT id, name FROM users');
		return view('admin',['users'=>$users]);
    }
   
	public function showPromoteView(){
		return view('AdminCreate');
	}
	
	public function createAdmin(Request $request){
		$email = Input::get('email');
		DB::table('users')
			->where('email', $email)
			->update(array('adminstatus' => 'yes'));
			$request->session()->flash('alert-success', 'The selected user has been promoted to an Administrator.');
		return redirect('AdminCreate');
	}
	
}
