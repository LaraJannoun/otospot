<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SupportCategory;
use App\Models\ContactForm;
use Validator;

class ContactController extends Controller
{

	public function support_categories()
	{
        $support_categories = SupportCategory::GeneralScope()->get();

		return parent::return_success($support_categories);
	}

    public function contact(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'full_name' => 'required',
			'support_category_id' => 'required|exists:support_categories,id',
			'message' => 'required'
		]);

		if($validator->fails()){
			return parent::return_error('Missing parameter(s)', 400, $validator->messages()->all()[0]);
		}

		ContactForm::create($request->merge([
			'support_category_id' => $request->support_category_id
		])->all());

		return parent::return_success(['message' => 'Your request has been submitted successfully']);
	}

}
