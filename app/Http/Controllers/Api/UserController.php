<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UserPush;
use Validator;
use Hash;
use Auth;

class UserController extends Controller
{
	/*
	* GET USER PROFILE
	*/
	public function profile()
	{
		// Get User
		$user = Auth::guard('api')->user();

		return parent::return_success($user);
	}

	/*
	* UPDATE USER PROFILE
	*/
	public function update(Request $request)
	{
		// Get User
		$user = Auth::guard('api')->user();

		// Check if the user exists
		$validator = Validator::make($request->all(), [
			'full_name' => 'required',
			'email' => 'required|email|unique:users,email,'.$user->id,
			'gender_id' => 'required|exists:genders,id'
        ]);

		if($validator->fails()){
			return parent::return_error('Missing parameter(s)', 400, $validator->messages()->all()[0]);
		}

        // Update user info
		$user->update($request->all());

		return parent::return_success($user);
	}

	/*
	* DELETE USER ACCOUNT
	*/
	public function delete_account(Request $request)
	{
		// Check if the user exists
		$validator = Validator::make($request->all(), [
			'password' => 'required'
		]);

		if($validator->fails()){
			return parent::return_error('Missing parameter(s)', 400, $validator->messages()->all()[0]);
		}

		// Get User
		$user = Auth::guard('api')->user();

		if(Hash::check($request->password, $user->password)) {
			$user->delete();
			return parent::return_success(['message' => 'Account successfully deleted!']);
		} else {
			return parent::return_error('Wrong Password', 400, 'Wrong password!');
		}

	}

	/*
	* USER LOGOUT
	*/
	public function logout()
	{
		// Get User
		$user = Auth::guard('api')->user();

		// Remove user player_id when logout
		if($user_push = UserPush::where('user_id', $user->id)->first()){
			$user_push->delete();
		}

		// Revoke Token
		$user->token()->revoke();

		return parent::return_success(['message' => 'User logged out!']);
	}

}