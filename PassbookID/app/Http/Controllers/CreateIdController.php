<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
class CreateIdController extends Controller
{
   public function showCreateIdDetails($type = null) {
	   return view('IdCreateDetails', ['type' => $type]);
   }
   
   public function showCreateContacts($type = null) {
	   return view('IdCreateEmergency' , ['type' => $type]);
   }
   
   public function showCreateEmpDetails() {
	   return view('IdCreateEmpDetails');
   }
   
   public function showLandingPage() {
	   return view('Landing');
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
			$filename = $request->id.".png";
			$request->file('photo')->move("C:\wamp64\www\PassbookID\PassbookID\public\img", $filename);
		}
		else {
			Session::flash('xsize', 'Photo is tubig, use less than 10MB');
			return redirect('/Details/student');
		}
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
	   $status = DB::table('users')
				-> where('email', \Auth::user()->email)
				->first();
		
		if ($status->createstatus == "no" && $request->type == "student") {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['createstatus' => 'yes']);
		}
		
		else if ($status->createstatusemp == "no" && $request->type == "employee") {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['createstatusemp' => 'yes']);
		}
	   return redirect('/UPD');
   }
}
