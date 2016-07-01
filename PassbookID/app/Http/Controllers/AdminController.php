<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use App\Department;
use App\Campus;
use App\CampusDepartment;

class AdminController extends Controller
{
    public function index(){
		$users = DB::select('SELECT idnum, sn_year, sn_num, name, createstatus, createstatusemp FROM users');
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
				$db_stud = DB::table('users')
					->where('email', '=', $email)
					->value('createstatus');
				if($db_stud=='no'){
					$db_admin = DB::table('users')
						->where('email', '=', $email)
						->value('adminstatus');
					if($db_admin=='no'){
						DB::table('users')
							->where('email', $email)
							->update(array('adminstatus' => 'yes'));
							$request->session()->flash('alert-success', 'The selected user has been promoted to an Administrator.');
					}
					else{
						$message = "The selected user is already an Administrator.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				else{
					$message = "The user must have an employee status, and must not be a student.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
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
				$db_stud = DB::table('users')
					->where('name', '=', $name)
					->value('createstatus');
				if($db_stud=="no"){
					$db_admin = DB::table('users')
						->where('name', '=', $name)
						->value('adminstatus');
					if($db_admin=='no'){
						DB::table('users')
							->where('name', $name)
							->update(array('adminstatus' => 'yes'));
							$request->session()->flash('alert-success', 'The selected user has been promoted to an Administrator.');
					}
					else{
						$message = "The selected user is already an Administrator.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				else{
					$message = "The user must have an employee status, and must not be a student.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
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
				$db_stud = DB::table('users')
					->where('idnum', '=', $idnum)
					->value('createstatus');
				if($db_stud=="no"){
					$db_admin = DB::table('users')
						->where('idnum', '=', $idnum)
						->value('adminstatus');
					if($db_admin=='no'){
						DB::table('users')
							->where('idnum', $idnum)
							->update(array('adminstatus' => 'yes'));
							$request->session()->flash('alert-success', 'The selected user has been promoted to an Administrator.');
					}
					else{
						$message = "The selected user is already an Administrator.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				else{
					$message = "The user must have an employee status, and must not be a student.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
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
	
	public function showIdExpire() {
		$campuses = DB::select('SELECT cname FROM campus');
		return view('AdminExpire', ['campuses' => $campuses]);
	}
	
	public function showCampDept() {
		$campuses = DB::select('SELECT cname FROM campus');
		return view('AdminCampDept', ['campuses' => $campuses]);
	}
	
	public function addCampDeptBranch(Request $request) {
		$input = $request->all();
		
		
		if($input['action'] == "addCampus") {
			if (!(DB::table('campus')->where('cname', $input['campus'])->first())) {
				$campus = new Campus;
				$campus->cname = $input['campus'];
				$campus->save();	
				Session::flash('success', 'The campus has been added!');
			}
			else {
				Session::flash('fail', 'Campus already exists');
			}
		}
		
		else {
			if (!(DB::table('dept')->where('dname', $input['dept'])->first())) {
				$dept = new Department;
				$dept->dname = $input['dept'];
				$dept->save();
			}
			
			$campdept = new CampusDepartment;
			$campdept->cname = $input['campusdept'];
			$campdept->dname = $input['dept'];
			$campdept->save();
			
			Session::flash('success', 'The department has been added!');
		}
		
		return redirect('/AdminCampDept');
	}
}
