<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ViewInfoController extends Controller
{
   public function showEmergencyDetails() {
	   return view('IdViewEmergency');
   }
   
   public function showEmergencyDetails1() {
	   return view('IdViewEmergency1');
   }
   public function showEmergencyDetails2() {
	   return view('IdViewEmergency2');
   }
}
