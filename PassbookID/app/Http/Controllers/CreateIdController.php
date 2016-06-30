<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use Redirect;
class CreateIdController extends Controller
{
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
	   
				
	   return view('IdCreateDetails', ['type' => $type, 'user' => $this->getLoggedInUser(), 'array' => $array, 'campuses' => $campuses]);
   }
   
   public function showCreateContacts($type = null) {
	   return view('IdCreateEmergency' , ['type' => $type, 'user' => $this->getLoggedInUser()]);
   }
   
   public function showCreateEmpDetails() {
	   return view('IdCreateEmpDetails' , ['user' => $this->getLoggedInUser()]);
   }
   
   public function showLandingPage() {
	   $campuses = DB::select('SELECT cname FROM campus');
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
		
		DB::table('users')
			->where('email', \Auth::user()->email)
			->update(['fname' => $request->fname, 'mname' => $request->mname, 'lname' => $request->lname, 'campus' => $request->campus, 'dept' => $request->dept]);
		
		if (isset($request->sname)) {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['sname' => $request->sname]);
		}
		
		if (isset($request->idnum)) {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['idnum' => $request->id]);
		}
		else {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['sn_year' => $request->sn_year, 'sn_num' => $request->sn_num]);
		}
		
		if ($request->campus == "none") {
			Session::flash('xsize', 'Invalid campus!');		
			return 0;			
		}
		
		if ($request->file('photo')->getClientSize() < 1000000){
			$filename = $request->sn_year.$request->sn_num.".jpg";
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
	   if ($request->type == 'student'){
			if($this->processDetails($request) == 0){
				return redirect()->back();
			}
			return redirect('/Contacts/student');
	   }
	   else if ($request->type == 'employeeL') {
		   $this->processEmpDetails($request);
		   return redirect('/Contacts/employee');
	   }
	   else {
			$this->processDetails($request);
			return redirect('/EmpDetails');
	   }
   }
   
   public function createId(Request $request) {
	
		$this->processContacts($request);
		$currUser = $this->getLoggedInUser();
		if ($currUser->createstatus == "no" && $request->type == "student") {
			DB::table('users')
				->where('email', $currUser->email)
				->update(['createstatus' => 'yes']);
		}
		
		else if ($currUser->createstatusemp == "no" && $request->type == "employee") {
			DB::table('users')
				->where('email', $currUser->email)
				->update(['createstatusemp' => 'yes']);
		}
		   
	   return redirect("/ViewId");
   }
   
   public function viewId() {
	   $user = $this->getLoggedInUser();
	   $campus = $user->campus;
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
	   else if($campus == "Mindanao"){
		   
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
