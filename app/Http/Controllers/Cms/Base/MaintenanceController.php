<?php

namespace App\Http\Controllers\Cms\Base;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\FilesHelper;
use App\Models\Maintenance;
use Artisan;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:maintenance-edit', ['only' => ['edit', 'update']]);
    }

    public function page_info()
    {
        $page_info = [
            'title' => 'Maintenance',
            'link' => 'maintenance'
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

        $row = Maintenance::findOrFail(1);

        return view('cms.base.'.$page_info['link'].'.edit', compact('page_info', 'row'));
    }

    /**
     * Update the specified row in the database
     *
     */
    public function update(Request $request)
    {
        $page_info = $this->page_info();

        $row = Maintenance::findOrFail(1);

        $this->validate($request, [
            'image' => 'mimes:png,jpg,jpeg|max:500',
            'title' => 'required|string|max:255',
            'text' => 'required',
            'secret' => 'required'
        ]);

        $image_path = $row->getAttributes()['image'];
        if($request->image){

            // Delete File
            FilesHelper::deleteFile(public_path().$image_path);

            $image_path = FilesHelper::storeFile($page_info['link'], $request->image, $request->title);
        }

        $row->update([
            'maintenance_mode' => $request->maintenance_mode ? 1 : 0,
            'image' => $image_path,
            'title' => $request->title,
            'text' => $request->text,
            'secret' => $request->secret
        ]);

        if($row->maintenance_mode){
            Artisan::call('down', ['--secret' => $row->secret]);
        } else {
            Artisan::call('up');
        }

        return redirect()->back()->withStatus('Record successfully updated.');
    }

    /**
     * Remove Brochure function
     *
     */
    public function imageRemove($id)
    {
        $row = Maintenance::findOrFail($id);

        // Delete File
        $image_path = $row->getAttributes()['image'];
        FilesHelper::deleteFile(public_path().$image_path);

        $row->image = null;
        $row->save();

        return redirect()->back()->withStatus('Image successfully deleted.');
    }

}
