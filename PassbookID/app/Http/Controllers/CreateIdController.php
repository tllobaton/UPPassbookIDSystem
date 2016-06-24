<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use DB;

class CreateIdController extends Controller
{
	public function getLoggedInUser(){
		return \Auth::user();
	}
   public function showCreateIdDetails($type = null) {
	   return view('IdCreateDetails', ['type' => $type, 'user' => $this->getLoggedInUser()]);
   }
   
   public function showCreateContacts($type = null) {
	   return view('IdCreateEmergency' , ['type' => $type, 'user' => $this->getLoggedInUser()]);
   }
   
   public function showCreateEmpDetails() {
	   return view('IdCreateEmpDetails' , ['user' => $this->getLoggedInUser()]);
   }
   
   public function showLandingPage() {
	   return view('Landing');
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
			->update(['fname' => $request->fname, 'mname' => $request->mname, 'lname' => $request->lname, 'idnum' => $request->id, 'campus' => $request->campus, 'dept' => $request->dept]);
			
		if (isset($request->sname)) {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['sname' => $request->sname]);
		
		}
		if ($request->file('photo')->getClientSize() < 1000000){
			$filename = $request->id.".jpg";
			$request->file('photo')->move("C:\wamp64\www\PassbookID\PassbookID\public\img", $filename);
		}
		else {
			Session::flash('xsize', 'Photo is tubig, use less than 10MB');
			return redirect('/Details/student');
		}
   }
   
   public function processContacts(Request $request){
		DB::table('users')
			->where('email', \Auth::user()->email)
			->update(['ename' => $request->ename, 'enum' => $request->enum, 'eaddress' => $request->eaddress]);
   }
   
   public function createIdBranch(Request $request) {
	   if ($request->type == 'student'){
			$this->processDetails($request);
			return redirect('/Contacts/student');
	   }
	   else if ($request->type == 'employeeL') {
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
	   if($campus == "UP Baguio"){
		   return view("UPB", ['user' => $user]);
	   }
	   else if($campus == "UP Cebu"){
		   
	   }
	   else if($campus == "UP Diliman"){
		   return view('UPD', ['user' => $user]);
	   }
	   else if($campus == "UP Los Baños"){
		   return view('UPLB', ['user' => $user]);
	   }
	   else if($campus == "UP Manila"){
		   return view('UPM', ['user' => $user]);
	   }
	   else if($campus == "UP Mindanao"){
		   
	   }
	   else if($campus == "UP Open University"){
		   return view('UPOU', ['user' => $user]);
	   }
	   else if($campus == "UP Visayas"){
		   return view('UPV', ['user' => $user]);
	   }
   }
}
