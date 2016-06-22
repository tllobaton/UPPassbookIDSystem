<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index(){
		$users = DB::select('SELECT id, name FROM users');
		return view('admin',['users'=>$users]);
    }
   
	public function showPromoteView(){
		return view('AdminCreate');
	}
}
