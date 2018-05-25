<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;

use Auth;

use App\User;


class LoginController extends Controller
{
    
	public function authenticate(LoginRequest $request)
	{

		if( Auth::attempt( [ 'email' => $request['email'], 'password' => $request['password'] ] ) )
		{

			return $this->redirects(Auth::User()->user_level);			

		}

		return redirect('/')->with('login_error','Login Failed');

	}

	public function redirects($user_level)
	{

		switch ($user_level) {

			case 1:

				return redirect()->intended('admin/dashboard');

				break;

			case 2:

				return redirect()->intended('receiver/dashboard');

				break;

			case 3:

				return redirect()->intended('user/dashboard');	

				break;
			
			default:
				
				return redirect()->intended('/')->with('login_error','Login Failed');

				break;
		}

	}
	

}
