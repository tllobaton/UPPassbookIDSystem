<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use Redirect;
use App\User;
use App\Campus;

class CreateIdController extends Controller {
	// Get logged in user
	public function getLoggedInUser(){
		return \Auth::user();
	}
	
   public function showCreateIdDetails($type = null) {
	   $campuses = DB::table('campus')
			->get();
		
		foreach ($campuses as $campus) {
			$array[$campus->cname] = DB::table('campus_dept')
				->select('dname')
				->where('cname', $campus->cname)
				->get();
		}
	   
				
	   return view('IdCreateDetails', ['type' => $type, 'user' => $this->getLoggedInUser(), 'array' => $array, 'campuses' => $campuses]);	// $type determines if student or empployee
   }
   
   public function showCreateContacts($type = null) {
	   return view('IdCreateEmergency' , ['type' => $type, 'user' => $this->getLoggedInUser()]);
   }
   
   public function showCreateEmpDetails() {
	   return view('IdCreateEmpDetails' , ['user' => $this->getLoggedInUser()]);
   }
   
   public function showLandingPage() {
	   $campuses = DB::select('SELECT cname FROM campus');
	   
	   foreach ($campuses as $campus) {
		   Campus::where('cname', $campus->cname)->update(['studentuse' => User::where('campus', $campus->cname)->where('createdsid', "yes")->count()]);
		   Campus::where('cname', $campus->cname)->update(['totalstudents' => User::where('campus', $campus->cname)->where('isenrolled', 'yes')->count()]);
		   
		   Campus::where('cname', $campus->cname)->update(['empuse' => User::where('campus', $campus->cname)->where('createdeid', "yes")->count()]);
		   Campus::where('cname', $campus->cname)->update(['totalemps' => User::where('campus', $campus->cname)->where('isemployed', 'yes')->count()]);
	   }
	   
	   $campuses = Campus::all();
	   return view('Landing', ['campuses' => $campuses]);
   }
   
   public function showEmergencyDetails() {
	   $user = $this->getLoggedInUser();
	   return view('IdViewEmergency', ['user' => $user]);
   }
   
   public function showEmergencyDetails1() {
	   $user = $this->getLoggedInUser();
	   return view('IdViewEmergency1', ['user' => $user]);
   }
   public function showEmergencyDetails2() {
	   $user = $this->getLoggedInUser();
	   return view('IdViewEmergency2', ['user' => $user]);
   }
   
   public function processDetails(Request $request){
		
		// add details to database
		DB::table('users')
			->where('email', \Auth::user()->email)
			->update(['fname' => $request->fname, 'mname' => $request->mname, 'lname' => $request->lname, 'campus' => $request->campus, 'dept' => $request->dept]);
		
		// check if user has suffix name (IV, Sr., Jr.)
		if (isset($request->sname)) {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['sname' => $request->sname]);
		}
		
		// check if user set idnum (employee id number) or sn_year/sn_num(student id number)
		if (isset($request->empnum)) {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['empnum' => $request->empnum]);
		}
		else {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['sn_year' => $request->sn_year, 'sn_num' => $request->sn_num]);
		}
		
		// check if valid campus is chosen
		if ($request->campus == "none") {
			Session::flash('xsize', 'Invalid campus!');		
			return 0;			
		}
		
		// check if photo is less than 10MB
		if ($request->file('photo')->getClientSize() < 1000000){
			if ($request->type == 'student') {
				$filename = $request->sn_year.$request->sn_num.".jpg";
			}
			else {
				$filename = $request->empnum.".jpg";
			}
			$request->file('photo')->move("C:\wamp64\www\PassbookID\PassbookID\public\img", $filename);
		}
		else {
			Session::flash('xsize', 'Photo is tubig, use less than 10MB');
			return 0;
		}
		return 1;
   }
   
   public function processContacts(Request $request){
		DB::table('users')
			->where('email', \Auth::user()->email)
			->update(['ename' => $request->ename, 'enum' => $request->enum, 'eaddress' => $request->eaddress]);
   }
   
   public function processEmpDetails(Request $request) {
		DB::table('users')
			->where('email', \Auth::user()->email)
			->update(['gsis' => $request->gsis, 'blood' => $request->blood, 'tin' => $request->tin, 'empstatus' => $request->empstatus]);
   }
   public function createIdBranch(Request $request) {
	   
	   // if user is creating student id, go to emergency contact details
	   if ($request->type == 'student'){
			if($this->processDetails($request) == 0){
				return redirect()->back();
			}
			return redirect('/Contacts/student');
	   }
	   // if user came from employee details, go to emergency contact details
	   else if ($request->type == 'employeeL') {
		   $this->processEmpDetails($request);
		   return redirect('/Contacts/employee');
	   }
	   
	   // if user is creating employee id, go to employee details
	   else {
			if($this->processDetails($request) == 0){
				return redirect()->back();
			}
			return redirect('/EmpDetails');
	   }
   }
   
   public function createId(Request $request) {
		// process emergency contact detials
		$this->processContacts($request);
		
		if ($request->type == 'student') {
			User::where('email', $this->getLoggedInUser()->email)->update(['createdsid' => 'yes']);
		}
		
		else {
			User::where('email', $this->getLoggedInUser()->email)->update(['createdeid' => 'yes']);
		}
		
		$currUser = $this->getLoggedInUser();		   
	   return redirect("/ViewId");
   }
   
   public function viewId() {
	   $user = $this->getLoggedInUser();
	   $campus = $user->campus;
	   
	   // check campus of user, return respective ID layout
	   if($campus == "Baguio"){
		   return view("UPB", ['user' => $user]);
	   }
	   else if($campus == "Cebu"){
		   
	   }
	   else if($campus == "Diliman"){
		   return view('UPD', ['user' => $user]);
	   }
	   else if($campus == "Los Baños"){
		   return view('UPLB', ['user' => $user]);
	   }
	   else if($campus == "Manila"){
		   return view('UPM', ['user' => $user]);
	   }
	   else if($campus == "Mindanao "){
		   
	   }
	   else if($campus == "Open University"){
		   return view('UPOU', ['user' => $user]);
	   }
	   else if($campus == "Visayas"){
		   return view('UPV', ['user' => $user]);
	   }
	   else{
		   $message = "You have not yet created a virtual ID.";
		   echo "<script type='text/javascript'>alert('$message');</script>";
		   return view("/Landing");
	   }
	   
	   
   }
}
