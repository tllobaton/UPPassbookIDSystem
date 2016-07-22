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
		return view('admin');
	}
	
    public function s_index(){
		// pagination for students
		$s_users = DB::table('users')
		->select('sn_year', 'sn_num', 'fname', 'mname', 'lname', 'sname', 'active')
		->where('isenrolled', '=', 'yes')
		->orderBy('lname', 'asc')
		->paginate(10);
		return view('admin',['s_users'=>$s_users]);
    }
	
	public function e_index(){
		// pagination for employees
		$e_users = DB::table('users')
		->select('empnum', 'fname', 'mname', 'lname', 'sname', 'active')
		->where('isemployed', '=', 'yes')
		->orderBy('lname', 'asc')
		->paginate(10);
		return view('admin', ['e_users'=>$e_users]);
	}
   
   public function search_adminview(Request $request){
	   //search for viewing users
	   $inp = $request['searchinput'];
	   $inp = '%'.$inp.'%';
	   
	   if($inp!="" || $inp!=null){
		   $results = DB::table('users')
				->select('fname', 'mname', 'lname', 'sname', 'email', 'sn_year', 'sn_num', 'empnum', 'isenrolled', 'active')
				->where('name', 'LIKE', $inp)
				->orWhere('email', 'LIKE', $inp)
				->orderBy('lname', 'asc')
				->paginate(10);
				return view('admin', ['results'=>$results]);
	   }
   }
   
	public function showPromoteView(){
		return view('AdminCreate');
	}
	
	public function search(Request $request){
		// search for promoting users to admin
		$inp = $request['searchinput'];
		$inp = '%'.$inp.'%';
		
		if($inp!="" || $inp!=null){
			$results = DB::table('users')
				->select('name', 'email')
				->where('isadmin', '=', 'no')
				->where('isemployed', '=', 'yes')
				->where('active', '=', 'yes')
				->where(function ($query) use ($inp){
					$query->where('name', 'LIKE', $inp)
						->orWhere('email', 'LIKE', $inp);
				})
				->orderBy('lname', 'asc')
				->paginate(5);
				return view('AdminCreate',['results'=>$results]);
		}
		else{
			$message = "No results found.";
			return view('AdminCreate', ['message'=>$message]);
		}
	}
	
	public function createAdmin(Request $request){
		// promote all users to addmin
		$checked = Input::get('promote');
		if(is_array($checked)){
			foreach($checked as $row){
				DB::table('users')
					->where('name', $row)
					->update(array('isadmin' => 'yes'));
			}
			$msg = "The selected user/s has/have been granted Administrator status.";
			return view('AdminCreate', ['msg'=>$msg]);
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
		// set expiration date of ID
		$currdate = new DateTime();
		$currdate->setTimezone(new DateTimeZone('Asia/Manila'));
		$currdate = $currdate->format('Y-m-d H:i:s');
		
		if($request->expdate==null || $request->expdate<=$currdate){
			Session::flash('danger', 'The expiry date is invalid.');
		}
		else{
			DB::table('campus')
				->where('cname', $request->campus)
				->update(['expire' => $request->expdate]);
			Session::flash('success', 'The expiry date has been set.');
		}
		return redirect('/AdminExpire');
	}
	
	public function showCampDept() {
		$campuses = DB::select('SELECT cname FROM campus');
		return view('AdminCampDept', ['campuses' => $campuses]);
	}
	
	public function addCampDeptBranch(Request $request) {
		$input = $request->all();
		
		// if user selects add campus, add campus from field to database
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
		
		// if user selects add department, add department from field to database then link department to respective campuse
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
		
		// move uploaded file to /public folder of directory
		$request->file('filetoopen')->move(base_path("public"), "UploadedUsers.csv");
		$file = fopen(base_path("public/UploadedUsers.csv"), "r");
		// record line number for error checking
		$linenumber = 1;
		
		// convert line from csv file to an array
		// index 0 : email, 1: last name, 2: first name, 3: middle initial, 4: suffix name, 5: isenrolled, 6: isemployed,
		$uploadArray = fgetcsv($file);
		
		
		while ($uploadArray != false){
			// if line has incomplete number of fields
			if (sizeof($uploadArray) != 7) {
				Session::flash('fail', 'Invalid format at line ' .$linenumber);
				fclose($file);
				unlink(base_path("public/UploadedUsers.csv"));
				return redirect("/AdminAddUsers");
			}
			
			// if user is already in database
			if (DB::table('users')->where('email', $uploadArray[0])->first()) {
				Session::flash('fail', 'User already in database at line ' .$linenumber);
				fclose($file);
				unlink(base_path("public/UploadedUsers.csv"));
				return redirect("/AdminAddUsers");
			}
			
			// if neither isenrolled and isemployed is yes
			if (($uploadArray[5] != "yes") AND ($uploadArray[6] != "yes")) {
				Session::flash('fail', 'User must be enrolled or employed at line ' .$linenumber);
				fclose($file);
				unlink(base_path("public/UploadedUsers.csv"));
				return redirect("/AdminAddUsers");
			}
			
			// if line doesn't have email
			if ($uploadArray[0] == "") {
				Session::flash('fail', 'User must have email at line ' .$linenumber);
				fclose($file);
				unlink(base_path("public/UploadedUsers.csv"));
				return redirect("/AdminAddUsers");
			}
			
			// add to database
			$user = new User;
			$user->email = $uploadArray[0];
			
			$user->lname = $uploadArray[1];
			$user->fname = $uploadArray[2];
			
			// if middle initial is null
			if ($uploadArray[3] ==""){
				$user->mname = null;
			}
			else {
				$user->mname = $uploadArray[3];
			}
			// if suffix name is null
			if ($uploadArray[4] == ""){
				$user->sname = null;
				$user->name = $uploadArray[2]." ".$uploadArray[1];
			}
			else {
				$user->sname = $uploadArray[4];
				$user->name = $uploadArray[2]." ".$uploadArray[1]. " ". $uploadArray[4];
			}
			if ($uploadArray[5] == "yes") {
				$user->isenrolled = $uploadArray[5];
			}
			if ($uploadArray[6] == "yes") {
				$user->isemployed = $uploadArray[6];
			}
			
			$user->save();
			$uploadArray = fgetcsv($file);
			$linenumber = $linenumber + 1;
		}
		
		Session::flash('success', 'Successfully imported file');
		fclose($file);
		unlink(base_path("public/UploadedUsers.csv"));
		
		return redirect('/AdminAddUsers');
	}
	
	public function AddDeactBranch(Request $request) {
		$input = $request->all();
		$msg = "";
		
		// if user chooses to deactivate selected users
		if ($input['action'] == 'deactivate') {
			$checked = Input::get('selected');
			if(is_array($checked)){
				// for each selected row, update row in database
				foreach($checked as $row){
					$db_active = DB::table('users')
						->where('name', '=', $row)
						->value('active');
					// check if user is active or inactive
					if($db_active == 'yes'){
						DB::table('users')
							->where('name', $row)
							->update(array('active' => 'no'));
							$msg = "The selected user account/s has/have been deactivated.";
					}
					
					// error if user is already deactivated
					else{
						$message = "The user is already deactivated.";
						return view('AdminDeleteUsers', ['message'=>$message]);
					}
				}
				return view('AdminDeleteUsers', ['msg'=>$msg]);
			}
			// error if no selected check box
			else{
				$message = "Please select at least one record from the list of users.";
				return view('AdminDeleteUsers', ['message'=>$message]);
			}
		}
		
		// if user chooses to activate selected users
		else {
			$checked = Input::get('selected');
			if(is_array($checked)){
				foreach($checked as $row){
					$db_active = DB::table('users')
						->where('name', '=', $row)
						->value('active');
					if($db_active == 'no'){
						DB::table('users')
							->where('name', $row)
							->update(array('active' => 'yes'));
							$msg = "The selected user account/s has/have been reactivated.";
					}
					else{
						$message = "The user is already active.";
						return view('AdminDeleteUsers', ['message'=>$message]);
					}
				}
				return view('AdminDeleteUsers', ['msg'=>$msg]);
			}
			else{
				$message = "Please select at least one record from the list of users.";
				return view('AdminDeleteUsers', ['message'=>$message]);
			}
		}
	}
	
	public function showDeleteUsers() {
		return view('AdminDeleteUsers');
	}
	// search function for activating/ deactivating users
	public function search1(Request $request){
		$inp = $request['searchinput'];
		$inp = '%'.$inp.'%';
		
		if($inp!="" || $inp!=null){
			$results = DB::table('users')
				->select('name', 'email', 'active')
				->where(function ($query) use ($inp){
					$query->where('name', 'LIKE', $inp)
						->orWhere('email', 'LIKE', $inp);
				})
				->orderBy('lname', 'asc')
				->paginate(5);
			return view('AdminDeleteUsers',['results'=>$results]);
		}
		else{
			$message = "No results found.";
			return view('AdminDeleteUsers', ['message'=>$message]);
		}
	}
	
	public function showRevokeView() {
		return view('AdminRevoke');
	}
	
	// search function for revoking admin status
	public function search_revoke(Request $request){
		$inp = $request['searchinput'];
		$inp = '%'.$inp.'%';
		
		if($inp!="" || $inp!=null){
			$results = DB::table('users')
				->select('name', 'email')
				->where('isadmin', '=', 'yes')
				->where('active', '=', 'yes')
				->where(function ($query) use ($inp){
					$query->where('name', 'LIKE', $inp)
						->orWhere('email', 'LIKE', $inp);
				})
				->orderBy('lname', 'asc')
				->paginate(5);
			return view('AdminRevoke',['results'=>$results]);
		}
		else{
			$message = "No results found.";
			return view('AdminRevoke', ['message'=>$message]);
		}
	}
	
	// remove user admin status
	public function removeAdmin(){
		$checked = Input::get('revoke');
		if(is_array($checked)){
			foreach($checked as $row){
				DB::table('users')
					->where('name', $row)
					->update(array('isadmin' => 'no'));
			}
			$msg = "Admin status revoked.";
			return view('AdminRevoke', ['msg'=>$msg]);
		}
		else{
			$message = "Please select at least one record from the list of users.";
			return view('AdminRevoke', ['message'=>$message]);
		}
	}
}
