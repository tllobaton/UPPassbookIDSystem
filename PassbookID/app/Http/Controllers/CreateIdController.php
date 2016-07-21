<?php

namespace App\Http\Controllers;

use App\Classes\PassKit;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use Redirect;
use App\User;
use App\Campus;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Response;

use Thenextweb\PassGenerator;

use Storage;

class CreateIdController extends Controller {
	// Get logged in user
	public function getLoggedInUser(){
		return \Auth::user();
	}
	
   public function showCreateIdDetails($type = null) {
	   // get all campuses
	   $campuses = DB::table('campus')
			->get();
		
		// get all departments in each campus, return as an array with index as campus name, e.g. $array['Diliman']
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
	   // array for blood type
	   $blood = ['A', 'B', 'AB', 'O'];
	   return view('IdCreateEmpDetails' , ['user' => $this->getLoggedInUser(), 'bloodtype' => $blood]);
   }
   
   public function FirstTimeLogin(Request $request) {
	   
	   // update user's campus
	   User::where('email', $this->getLoggedInUser()->email)->update(['campus' => $request->campus]);
	   return redirect('/Landing');
   }
   
   public function showLandingPage() {
	   
	   // if campus is null, user has logged in before
	   if ($this->getLoggedInUser()->campus != null) {
		   
		   // select all campus names
		   $campuses = DB::select('SELECT cname FROM campus');
		   foreach ($campuses as $campus) {
			   
			   // count all students who have created ids, noted by createsid column
			   Campus::where('cname', $campus->cname)->update(['studentuse' => User::where('campus', $campus->cname)->where('createdsid', "yes")->count()]);
			   
			   // count all students in the database, noted by isenrolled column
			   Campus::where('cname', $campus->cname)->update(['totalstudents' => User::where('campus', $campus->cname)->where('isenrolled', 'yes')->count()]);
			   
			   // count all employees who have created ids, noted by createeid column
			   Campus::where('cname', $campus->cname)->update(['empuse' => User::where('campus', $campus->cname)->where('createdeid', "yes")->count()]);
			   
			   // count all employees in the database, noted by isemployed column
			   Campus::where('cname', $campus->cname)->update(['totalemps' => User::where('campus', $campus->cname)->where('isemployed', 'yes')->count()]);
		   }
		   
		   // count all students who haven't logged in at all
		   $studentnull = User::where('campus', null)->where('isenrolled', 'yes')->count();
		   
		   // count all employees who haven't logged in at all
		   $empnull = User::where('campus', null)->where('isemployed', 'yes') ->count();
		   
		   // return all campuses
		   $campuses = Campus::all();
		   
		   return view('Landing', ['campuses' => $campuses, 'studentnull' => $studentnull, 'empnull' => $empnull]);
	   }
	   
	   // first time user logs in
	   else {
		   $campuses = Campus::all();
		   return view('LandingDetails', ['campuses' => $campuses]);
	   }
	   
   }
   
   public function showEmergencyDetails($type = null) {
	   $user = $this->getLoggedInUser();
	   return view('IdViewEmergency', ['type' => $type, 'user' => $user]);
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
			->update(['fname' => $request->fname, 'lname' => $request->lname, 'campus' => $request->campus, 'dept' => $request->dept]);
		
		// check if user has suffix name (IV, Sr., Jr.)
		if ($request->sname != "") {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['sname' => $request->sname]);
		}
		else {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['sname' => null]);
		}
		
		// check if user has middle initial
		if ($request->mname != "") {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['mname' => $request->mname]);
		}
		else {
			DB::table('users')
				->where('email', \Auth::user()->email)
				->update(['mname' => null]);
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
			// photos are stored in /public/wallet/studentnumber, e.g. /public/wallet/201349426
			if ($request->type == 'student') {
				$dirname = $request->sn_year.$request->sn_num;
			}
			// photos are stored in /public/wallet/empnumber, e.g. /public/wallet/201349426
			else {
				$dirname = $request->empnum;
			}
			// move photo to directory above, save picture as thumbnail.png
			$request->file('photo')->move(base_path('public/wallet/'.$dirname), 'thumbnail.png');
		}
		else {
			Session::flash('xsize', 'Photo is tubig, use less than 10MB');
			return 0;
		}
		return 1;
   }
   
   public function processContacts(Request $request){
		// store contacts in database from contacts form
		DB::table('users')
			->where('email', \Auth::user()->email)
			->update(['ename' => $request->ename, 'enum' => $request->enum, 'eaddress' => $request->eaddress]);
   }
   
   public function processEmpDetails(Request $request) {
		// store contacts in database from employee details form
		DB::table('users')
			->where('email', \Auth::user()->email)
			->update(['gsis' => $request->gsis, 'blood' => $request->blood, 'tin' => $request->tin, 'empstatus' => $request->empstatus]);
   }
   public function createIdBranch(Request $request) {
	   
	   // if user is creating student id, go to emergency contact details for students
	   if ($request->type == 'student'){
			if($this->processDetails($request) == 0){
				return redirect()->back();
			}
			return redirect('/Contacts/student');
	   }
	   // if user came from employee details, go to emergency contact details for employees
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
		
		// if user clicks "create student id", update database 
		if ($request->type == 'student') {
			User::where('email', $this->getLoggedInUser()->email)->update(['createdsid' => 'yes']);
		}
		// if user clicks "create employee id", update database 
		else {
			User::where('email', $this->getLoggedInUser()->email)->update(['createdeid' => 'yes']);
		}
		
		$currUser = $this->getLoggedInUser();		   
	   return redirect("/ViewId/".$request->type);
   }
   
   public function viewId($type = null) {
	   $user = $this->getLoggedInUser();
	   $campus = $user->campus;
		// view what the id looks like
	   if(isset($campus)){
			return view('ID', ['user' => $user, 'type' => $type]);
	   }
	   else{
		   $message = "You have not yet created a virtual ID.";
		   echo "<script type='text/javascript'>alert('$message');</script>";
		   return view("/Landing");
	   }
   }
   
   // function that generates the .pkpass file
   public function makePass($type = null) {
		
		$user = $this->getLoggedInUser();
		
		// get expiration date
		$campusexpire = DB::table('campus')
					->select('expire')
					->where('cname', $user->campus)
					->first();
					
		// check if campus expire is null
		$currdate = new DateTime();
		$currdate->setTimezone(new DateTimeZone('Asia/Manila'));
		$currdate = $currdate->format('Y-m-d H:i:s');
		if ($campusexpire == null OR $campusexpire <= $currdate) {
			Session::flash('null', 'Expiry date invalid. Contact admin to fix.');
			return redirect("/ViewId/".$type);
		}
		
		// check if user has middle initial
		if($user->mname != null) {
			// check if user has suffix
			if ($user->sname != null) {
				// add dot if suffix is Jr. or Sr.
				if ($user->sname == "Jr" OR $user->sname == "Sr") {
					$name = $user->fname." ".$user->mname.". ".$user->lname." ".$user->sname.".";
				}
				else {
					$name = $user->fname." ".$user->mname.". ".$user->lname." ".$user->sname;
				}
			}
			else {
				$name = $user->fname." ".$user->mname.". ".$user->lname;
			}
			
		}
		// check if user doesn't have middle initial
		else {
			if ($user->sname == null) {
				$name = $user->fname." ".$user->lname;
			}
			// check if user has suffix
			else {
				// add dot if suffix is Jr. or Sr.
				if ($user->sname == "Jr" OR $user->sname == "Sr"){
					$name = $user->fname." ".$user->lname. " ". $user->sname. ".";
				}
				else {
					$name = $user->fname." ".$user->lname. " ". $user->sname;
				}
			}
		}
		
		// if user is creating a student id
		if ($type == "student"){
			$pass_identifier = $user->sn_year.$user->sn_num;  // This, if set, it would allow for retrieval later on of the created Pass
			
			// check and delete if user already made previous id
			if (Storage::disk('passgenerator')->has($pass_identifier.'.pkpass')) {	
				Storage::disk('passgenerator')->delete($pass_identifier.'.pkpass');
			}
			
			$pass = new PassGenerator($pass_identifier);

			$pass_definition = [
				"description"       => "UP ID",
				"formatVersion"     => 1,
				"organizationName"  => "University of the Philippines",
				"passTypeIdentifier"=> "ph.edu.up.PassID",
				"serialNumber"      => $user->sn_year.$user->sn_num,
				"teamIdentifier"    => "A7FDKGVVEB",
				"expirationDate"	=> $campusexpire->expire."T00:00:00",
				"foregroundColor"   => "rgb(99, 99, 99)",
				"backgroundColor"   => "rgb(212, 212, 212)",
				"logoText" => "University of the Philippines ".$user->campus,
				"barcode" => [
					"message"   => $user->sn_year."-".$user->sn_num,
					"format"    => "PKBarcodeFormatCode128",
					"messageEncoding"=> "utf-8"
				],
				"generic" => [
					"primaryFields" => [
						[
							// full name
							"key" => "name",
							"label" => "Name:",
							"value" => $name
						]
					],
					"secondaryFields" => [
						[
							// student number
							"key" => "snNo",
							"label" => "Student #:",
							"value" => $user->sn_year."-".$user->sn_num
						],
						[
							// if user is student, align right
							"key" => "type",
							"label" => "Student",
							"textAlignment" => "PKTextAlignmentRight"
						]
					],
					"auxiliaryFields" => [
						[
							// college/department
							"key" => "unit",
							"label" => "Unit/College:",
							"value" => $user->dept
						],
						[
							// expiration date of ID
							"key" => "validity",
							"label" => "Valid until:",
							"value" => $campusexpire->expire
						]
					],
					// person to contact in case of emergency
					"backFields" => [
						[
							"key" => "label",
							"value" => "Person to contact in case of emergency"
						],[
							"key" => "ename",
							"label" => "Name: ",
							"value" => $user->ename
						], [
							"key" => "enum",
							"label" => "Number: ",
							"value" => $user->ename
						], [
							"key" => "eadd",
							"label" => "Address: ",
							"value" => $user->eaddress
						]
					],
				],
			];

			$pass->setPassDefinition($pass_definition);

			// Definitions can also be set from a JSON string
			// $pass->setPassDefinition(file_get_contents('/path/to/pass.json));

			// Add assets to the PKPass package
			
			// get saved photo, must be named as thumbnail.png
			$pass->addAsset(base_path('/public/wallet/'.$user->sn_year.$user->sn_num.'/thumbnail.png'));
			$pass->addAsset(base_path('/resources/assets/wallet/icon.png'));
			$pass->addAsset(base_path('/resources/assets/wallet/logo.png'));

			$pkpass = $pass->create();
			
			// download the pass
			return new Response($pkpass, 200, [
				'Content-Transfer-Encoding' => 'binary',
				'Content-Description' => 'File Transfer',
				'Content-Disposition' => 'attachment; filename="pass.pkpass"',
				'Content-length' => strlen($pkpass),
				'Content-Type' => PassGenerator::getPassMimeType(),
				'Pragma' => 'no-cache',
			]);
		}
		// for employee ids
		else {
			$pass_identifier = $user->empnum;  // This, if set, it would allow for retrieval later on of the created Pass
			
			if (Storage::disk('passgenerator')->has($pass_identifier.'.pkpass')) {	
				Storage::disk('passgenerator')->delete($pass_identifier.'.pkpass');
			}
			
			$pass = new PassGenerator($pass_identifier);

			$pass_definition = [
				"description"       => "UP ID",
				"formatVersion"     => 1,
				"organizationName"  => "University of the Philippines",
				"passTypeIdentifier"=> "ph.edu.up.PassID",
				"serialNumber"      => $user->empnum,
				"teamIdentifier"    => "A7FDKGVVEB",
				"expirationDate"	=> $campusexpire->expire."T00:00:00",
				"foregroundColor"   => "rgb(0, 0, 0)",
				"backgroundColor"   => "rgb(255, 255, 255)",
				"logoText" => "University of the Philippines ".$user->campus,
				"barcode" => [
					"message"   => $user->empnum,
					"format"    => "PKBarcodeFormatCode128",
					"messageEncoding"=> "utf-8"
				],
				"generic" => [
					"primaryFields" => [
						[
							"key" => "name",
							"label" => "Employee Name:",
							"value" => $name
						],

					],
					"secondaryFields" => [
						[
							"key" => "empNo",
							"label" => "Employee No.:",
							"value" => $user->empnum
						],
						[
							"key" => "type",
							"label" => "Faculty",
							"textAlignment" => "PKTextAlignmentRight"
						]
					],
					"auxiliaryFields" => [
						[
							"key" => "unit",
							"label" => "Unit/College:",
							"value" => $user->dept
						],
						[
							"key" => "validity",
							"label" => "Valid until:",
							"value" => $campusexpire->expire
						]
					],
					"backFields" => [
						[
							"key" => "label",
							"value" => "Person to contact in case of emergency"
						],[
							"key" => "ename",
							"label" => "Name: ",
							"value" => $user->ename
						], [
							"key" => "enum",
							"label" => "Number: ",
							"value" => $user->ename
						], [
							"key" => "eadd",
							"label" => "Address: ",
							"value" => $user->eaddress
						]
					],
				],
			];

			$pass->setPassDefinition($pass_definition);

			// Definitions can also be set from a JSON string
			// $pass->setPassDefinition(file_get_contents('/path/to/pass.json));

			// Add assets to the PKPass package
			//$pass->addAsset(base_path('resources\assets\wallet\background.png'));
			
			$pass->addAsset(base_path('/public/wallet/'.$user->empnum.'/thumbnail.png'));
			$pass->addAsset(base_path('/resources/assets/wallet/icon.png'));
			$pass->addAsset(base_path('/resources/assets/wallet/logo.png'));

			$pkpass = $pass->create();
			
			return new Response($pkpass, 200, [
				'Content-Transfer-Encoding' => 'binary',
				'Content-Description' => 'File Transfer',
				'Content-Disposition' => 'attachment; filename="pass.pkpass"',
				'Content-length' => strlen($pkpass),
				'Content-Type' => PassGenerator::getPassMimeType(),
				'Pragma' => 'no-cache',
			]);
		}
	}
	
	public function test() {
 		$apiKey = '7RxgL2HIDBM0RFXOtWVt';
 		$apiSecret = 'SNgplReG0dY9NMTUT1bzMOqvY4FKlfHH7r3NcOmLDTFqeOCHX28z.';
 		$templateName = "testID";
 		$pk = new PassKit($apiKey, $apiSecret);
 	
 		$result = $pk->getTemplateFieldNames($templateName);
		dd($result);
 	}
}
