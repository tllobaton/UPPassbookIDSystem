<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
class CreateIdController extends Controller
{
   public function showCreateIdDetails($type = null) {
	   return view('IdCreateDetails', ['type' => $type]);
   }
   
   public function showCreateContacts() {
	   return view('IdCreateEmergency');
   }
   
   public function showCreateEmpDetails() {
	   return view('IdCreateEmpDetails');
   }
   
   public function showLandingPage() {
	   return view('Landing');
   }
   
   public function processDetails(Request $request){
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
			return redirect('/Contacts');
	   }
	   else if ($request->type == 'employeeL') {
		   return redirect('/Contacts');
	   }
	   else {
			$this->processDetails($request);
			return redirect('/EmpDetails');
	   }
   }
   
   public function createId(Request $request) {
	   return redirect('/UPD');
   }
}
