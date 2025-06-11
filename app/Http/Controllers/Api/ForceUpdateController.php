<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\ForceUpdate;

class ForceUpdateController extends Controller
{
	public function index()
	{
		$force_update = ForceUpdate::select([
			'title',
			'text',
			'android_version',
			'force_update_android',
			'ios_version',
			'force_update_ios'
		])->first();

		return response()->json($force_update);
	}
}
