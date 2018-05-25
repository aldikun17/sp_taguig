<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class WebController extends Controller
{
    
	public function index()
	{

		return view('web.login');

	}

	public function sign_out()
	{

		Auth::logout();

		return redirect('/')->with('logout_success','Logout Success');

	}

}
