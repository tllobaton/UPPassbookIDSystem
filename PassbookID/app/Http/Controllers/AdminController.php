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
		$users = DB::select('SELECT idnum, name, createstatusemp FROM users');
		return view('admin',['users'=>$users]);
    }
   
	public function showPromoteView(){
		return view('AdminCreate');
	}
	
	public function createAdmin(Request $request){
		$email = Input::get('email');
		$name = Input::get('username');
		$idnum = Input::get('idnum');
		if($email!=""){
			$db_email = DB::table('users')
				->where('email', '=', $email)
				->first();
			if(!is_null($db_email)){
				DB::table('users')
					->where('email', $email)
					->update(array('adminstatus' => 'yes'));
					$request->session()->flash('alert-success', 'The selected user has been promoted to an Administrator.');
			}
			else{
			    $message = "The user with the email " . $email . " does not exist.";
			    echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		else if($name!=""){
			$db_name = DB::table('users')
				->where('name', '=', $name)
				->first();
			if(!is_null($db_name)){
				DB::table('users')
					->where('name', $name)
					->update(array('adminstatus' => 'yes'));
					$request->session()->flash('alert-success', 'The selected user has been promoted to an Administrator.');

			}
			else{
			    $message = "The user with the name " . $name . " does not exist.";
			    echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		else if($idnum!=""){
			$db_id = DB::table('users')
				->where('idnum', '=', $idnum)
				->first();
			if(!is_null($db_id)){
				DB::table('users')
					->where('idnum', $idnum)
					->update(array('adminstatus' => 'yes'));
					$request->session()->flash('alert-success', 'The selected user has been promoted to an Administrator.');
			}
			else{
			    $message = "The user with the Student Number/Employee ID " . $idnum . " does not exist or has not created an ID.";
			    echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		else{
		   $message = "Search field must not be blank. Only one input field can have a value.";
		   echo "<script type='text/javascript'>alert('$message');</script>";
		}
		return view('AdminCreate');
	}
	
}
