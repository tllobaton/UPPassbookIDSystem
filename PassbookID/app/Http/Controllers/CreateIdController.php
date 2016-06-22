<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CreateIdController extends Controller
{
   public function showCreateIdDetails() {
	   return view('IdCreateDetails');
   }
   
   public function showCreateContacts() {
	   return view('IdCreateEmergency');
   }
   
   public function showCreateEmpDetails() {
	   return view('IdCreateEmpDetails');
   }
}
