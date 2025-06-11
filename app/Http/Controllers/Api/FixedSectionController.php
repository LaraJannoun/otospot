<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\FixedSection;

class FixedSectionController extends Controller
{

    public function about()
    {
        $section = FixedSection::where('slug', 'about')->firstOrFail();

        return parent::return_success($section);
    }

    public function terms()
    {
        $section = FixedSection::select(['title', 'text'])->where('slug', 'terms')->firstOrFail();

        return parent::return_success($section);
    }

}
