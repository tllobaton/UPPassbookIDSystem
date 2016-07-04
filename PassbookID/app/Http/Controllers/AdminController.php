<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use App\User;
use App\Department;
use App\Campus;
use App\CampusDepartment;

class AdminController extends Controller
{
    public function index(){
		$users = DB::select('SELECT empnum, sn_year, sn_num, name, isenrolled, isemployed FROM users');
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
						->value('isenrolled');
					if($db_stud=='no'){
						$db_admin = DB::table('users')
							->where('name', '=', $row)
							->value('isadmin');
						if($db_admin=='no'){
							DB::table('users')
								->where('name', $row)
								->update(array('isadmin' => 'yes'));
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
	
	public function showAddUsers() {
		return view('AdminAddUsers');
	}
	
	public function addUsers(Request $request) {
		$request->file('filetoopen')->move("C:\wamp64\www\PassbookID\PassbookID\public", "UploadedUsers.csv");
		$file = fopen("C:\wamp64\www\PassbookID\PassbookID\public\UploadedUsers.csv", "r");
		$linenumber = 1;
		$uploadArray = fgetcsv($file);
		
		
		while ($uploadArray != false){
			if (sizeof($uploadArray) != 6) {
				Session::flash('fail', 'Invalid format at line ' .$linenumber);
				fclose($file);
				unlink("C:\wamp64\www\PassbookID\PassbookID\public\UploadedUsers.csv");
				return redirect("/AdminAddUsers");
			}
			
			if (DB::table('users')->where('email', $uploadArray[0])->first()) {
				Session::flash('fail', 'User already in database at line ' .$linenumber);
				fclose($file);
				unlink("C:\wamp64\www\PassbookID\PassbookID\public\UploadedUsers.csv");
				return redirect("/AdminAddUsers");
			}
			
			if (($uploadArray[4] != "yes") AND ($uploadArray[5] != "yes")) {
				Session::flash('fail', 'User must be enrolled or employed at line ' .$linenumber);
				fclose($file);
				unlink("C:\wamp64\www\PassbookID\PassbookID\public\UploadedUsers.csv");
				return redirect("/AdminAddUsers");
			}
			
			if ($uploadArray[0] == "") {
				Session::flash('fail', 'User must have email at line ' .$linenumber);
				fclose($file);
				unlink("C:\wamp64\www\PassbookID\PassbookID\public\UploadedUsers.csv");
				return redirect("/AdminAddUsers");
			}
			
			$user = new User;
			$user->email = $uploadArray[0];
			
			$user->lname = $uploadArray[1];
			$user->fname = $uploadArray[2];
			$user->mname = $uploadArray[3];
			
			if ($uploadArray[4] == "yes") {
				$user->isenrolled = $uploadArray[4];
			}
			
			if ($uploadArray[5] == "yes") {
				$user->isemployed = $uploadArray[5];
			}
			
			$user->name = $uploadArray[2]." ".$uploadArray[1];
			$user->save();
			$uploadArray = fgetcsv($file);
			$linenumber = $linenumber + 1;
		}
		
		Session::flash('success', 'Successfully imported file');
		fclose($file);
		unlink("C:\wamp64\www\PassbookID\PassbookID\public\UploadedUsers.csv");
		
		return redirect('/AdminAddUsers');
		
		
	}
}
