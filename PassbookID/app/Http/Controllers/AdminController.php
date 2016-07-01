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
	
	public function search(Request $request){
		$inp = $request['searchinput'];
		
		if($inp!="" || $inp!=null){
			$results = DB::select("SELECT name, email FROM users WHERE (name LIKE '%$inp%' OR email LIKE '%$inp%') AND (name LIKE '%$inp%' OR email LIKE '%$inp%')");
			return view('AdminCreate',['results'=>$results]);
		}
		else{
			$message = "No results found.";
			return view('AdminCreate', ['message'=>$message]);
		}
	}
	
	public function createAdmin(Request $request){
		$checked = Input::get('promote');
		if(is_array($checked)){
			foreach($checked as $row){
				//print_r($row);
				$db_name = DB::table('users')
					->where('name', '=', $row)
					->first();
				if(!is_null($db_name)){
					$db_stud = DB::table('users')
						->where('name', '=', $row)
						->value('createstatus');
					if($db_stud=='no'){
						$db_admin = DB::table('users')
							->where('name', '=', $row)
							->value('adminstatus');
						if($db_admin=='no'){
							DB::table('users')
								->where('name', $row)
								->update(array('adminstatus' => 'yes'));
								$msg = "The selected user has been promoted to an Administrator.";
								return view('AdminCreate', ['msg'=>$msg]);
						}
						else{
							$message = "The selected user is already an Administrator.";
							return view('AdminCreate', ['message'=>$message]);
						}
					}
					else{
						$message = "The user must have an employee status, and must not be a student.";
						return view('AdminCreate', ['message'=>$message]);
					}
				}
				else{
					$message = "The user with the email " . $email . " does not exist.";
					return view('AdminCreate', ['message'=>$message]);
				}
			}
		}
		else{
			$message = "Please select at least one record from the list of users.";
			return view('AdminCreate', ['message'=>$message]);
		}
		
		
		
		
		
		
		
		
		/*if(is_array($checked)){						//if checkbox is ticked
			foreach($checked as $cbox){
				$db_name = DB::table('users')
					->where('name', '=', $cbox->name)
					->first();
				if(!is_null($db_name)){
					$db_stud = DB::table('users')
						->where('name', '=', $cbox->name)
						->value('createstatus');
					if($db_stud=='no'){
						$db_admin = DB::table('users')
							->where('name', '=', $cbox->name)
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
					$message = "The user with the email " . $email . " does not exist.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
		}
		else{
		   $message = "Please select at least one record from the list of users.";
		   echo "<script type='text/javascript'>alert('$message');</script>";
		}*/
		//return view('AdminCreate');
	}
	
	public function showIdExpire() {
		$campuses = DB::select('SELECT cname FROM campus');
		return view('AdminExpire', ['campuses' => $campuses]);
	}
	
	public function setIdExpire(Request $request) {
		DB::table('campus')
			->where('cname', $request->campus)
			->update(['expire' => $request->expdate]);
		Session::flash('success', 'The expiry date set');
		return redirect('/AdminExpire');
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
