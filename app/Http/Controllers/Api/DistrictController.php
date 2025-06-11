<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\District;

class DistrictController extends Controller
{

	public function index()
	{
        $districts = District::GeneralScope()->get();

		return parent::return_success($districts);
	}

}
