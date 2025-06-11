<?php

namespace App\Http\Controllers\Cms\Base;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:settings-edit', ['only' => ['edit', 'update']]);
    }

    public function page_info()
    {
        $page_info = [
            'title' => 'Settings',
            'link' => 'settings'
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

        $row = Setting::findOrFail(1);

        return view('cms.base.'.$page_info['link'].'.edit', compact('page_info', 'row'));
    }

    /**
     * Update the specified row in the database
     *
     */
    public function update(Request $request)
    {
        $row = Setting::findOrFail(1);

        $row->update([
            'android_app' => $request->android_app,
            'apple_app' => $request->apple_app
        ]);

        return redirect()->back()->withStatus('Record successfully updated.');
    }

}
