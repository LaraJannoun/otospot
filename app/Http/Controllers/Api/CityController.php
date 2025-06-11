<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{

	public function index(Request $request)
	{
		$district_id = $request->district_id;
		
        $cities = City::GeneralScope()->where('district_id', $district_id)->get();

		return parent::return_success($cities);
	}

}
