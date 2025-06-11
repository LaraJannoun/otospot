<?php

namespace App\Http\Controllers\Cms\Base;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\FixedSection;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:terms_and_conditions-edit', ['only' => ['edit', 'update']]);
    }

    public function page_info()
    {
        $page_info = [
            'title' => 'Terms and Conditions',
            'link' => 'terms-and-conditions'
        ];
        return $page_info;
    }

    /**
     * Show the form for editing the specified row
     *
     */
    public function edit()
    {
        $page_info = $this->page_info();

        $row = FixedSection::where('slug', 'terms-and-conditions')->firstOrFail();

        return view('cms.base.'.$page_info['link'].'.edit', compact('page_info', 'row'));
    }

    /**
     * Update the specified row in the database
     *
     */
    public function update(Request $request)
    {
        $row = FixedSection::where('slug', 'terms-and-conditions')->firstOrFail();

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'text' => 'required'
        ]);

         $row->update([
            'title' => $request->title,
            'text' => $request->text
        ]);

        return redirect()->back()->withStatus('Record successfully updated.');
    }

}
