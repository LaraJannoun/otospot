<?php

namespace App\Http\Controllers\Cms\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

	public function showLoginForm()
	{
		return view('cms.auth.login');
	}

	public function login(Request $request)
	{
		// Validate the form data
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required'
		]);

		// Attempt to log the user in
		if(Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
			// If success, redirect to their intended location
			return redirect()->intended(route('admin.dashboard'));
		}

		// If unsuccessful, the redirect back to the login page with the form data
		return redirect()->back()->withInput($request->only('email'))->with('error', 'Wrong email or password');;
	}

	public function logout()
	{
		Auth::guard('admin')->logout();
		return redirect()->route('admin.login');
	}

}
