<?php

namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;

class LoginController extends Controller
{
	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'mobile_number' => 'required'
		]);

		if($validator->fails()){
			return parent::return_error('Missing parameter(s)', 400, $validator->messages()->all()[0]);
		}

        $user_exists = User::where('mobile_number', $request->mobile_number)->first();

        // Generate pin / verificationID
        $pin = rand(100000,999999);
        $verificationID = Str::random(32);

        if(!$user_exists){
            // Create User
            User::create([
                'mobile_number' => $request->mobile_number,
                'pin' => $pin,
                'verificationID' => $verificationID
            ]);
        } else {
            // Update User
            $user_exists->update([
                'pin' => $pin,
                'verificationID' => $verificationID
            ]);
        }

        $response = [
            'pin' => $pin,
            'verificationID' => $verificationID
        ];

        return parent::return_success($response);
    }

}
