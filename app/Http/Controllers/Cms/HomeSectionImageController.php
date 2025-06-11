<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\HomeSectionImage;
use App\Models\HomeSection;
use Storage;

class HomeSectionImageController extends Controller
{

    public function page_info()
    {
        $page_info = [
            'title' => 'Home Section Images',
            'link' => 'home-section-images',
            'table_name' => 'home_section_images'
        ];
        return $page_info;
    }

    /**
     * Display a listing of the Table
     *
     */
    public function index()
    {
        $page_info = $this->page_info();

        $rows = HomeSectionImage::select([
            'id',
            'home_section_id',
            'image',
            'alt',
            'publish',
            'pos',
        ])->orderBy('pos', 'asc')->get();

        return view('cms.pages.'.$page_info['link'].'.index', compact('page_info', 'rows'));
    }

    /**
     * Display a listing of the specified row
     *
     */
    public function show($id)
    {
        $page_info = $this->page_info();

        $row = HomeSectionImage::findOrFail($id);

        return view('cms.pages.'.$page_info['link'].'.show', compact('page_info', 'row'));
    }

    /**
     * Show the form for creating a new row
     *
     */
    public function create()
    {
        $page_info = $this->page_info();
        $sections = HomeSection::get();

        return view('cms.pages.'.$page_info['link'].'.create', compact('page_info', 'sections'));
    }

    /**
     * Store a newly created row in the database
     *
     */
    public function store(Request $request)
    {
        $page_info = $this->page_info();

        $image_path = null;
        if($request->image){
            $this->validate($request, [
                'image' => 'required|mimes:mp4,mov,ogg,qt,png,jpg,jpeg'
            ]);
            $image_path = parent::store_file($page_info['link'], $request->image);
        }

        $row = new HomeSectionImage;
        $row->home_section_id = $request->home_section_id;
        $row->image = $image_path;
        $row->alt = $request->alt;

        $row->save();

        return redirect()->route('admin.'.$page_info['link'].'.index')->withStatus('Record successfully created.');
    }

    /**
     * Show the form for editing the specified row
     *
     */
    public function edit($id)
    {
        $page_info = $this->page_info();

        $row = HomeSectionImage::findOrFail($id);
        $sections = HomeSection::get();

        return view('cms.pages.'.$page_info['link'].'.edit', compact('page_info', 'row', 'sections'));
    }

    /**
     * Update the specified row in the database
     *
     */
    public function update(Request $request, $id)
    {
        $page_info = $this->page_info();

        $row = HomeSectionImage::findOrFail($id);

        // Check if the image exists
        $image_path = $row['image'];
        if($request->image){
            $this->validate($request, [
                'image' => 'required|mimes:mp4,mov,ogg,qt,png,jpg,jpeg'
            ]);
            $image_path = parent::store_file($page_info['link'], $request->image);
        }
        
        $row->image = $image_path;
        $row->home_section_id = $request->home_section_id;
        $row->alt = $request->alt;

        $row->save();

        return redirect()->route('admin.'.$page_info['link'].'.index')->withStatus('Record successfully updated.');
    }

    /**
     * Remove the specified row from the database
     *
     */
    public function destroy($id)
    {
        $page_info = $this->page_info();

        HomeSectionImage::findOrFail($id)->delete();

        return redirect()->route('admin.'.$page_info['link'].'.index')->withStatus('Record successfully deleted.');
    }

    /**
     * Remove Brochure function
     *
     */
    public function imageRemove($id)
    {
        $page_info = $this->page_info();

        $row = HomeSectionImage::findOrFail($id);
        $row->image = null;
        $row->save();

        return redirect()->route('admin.'.$page_info['link'].'.index')->withStatus('Record successfully deleted.');
    }

    public function publish(Request $request)
    {
        $id = $request['id'];
        $row = HomeSectionImage::findOrFail($id);
        $row->publish = !$row->publish;
        $row->save();

        return [
            'code' => 200,
            'status' => 'Success',
            'data' => $row->publish
        ];
    }

    /**
     * Show the form for ordering all rows
     *
     */
    public function order()
    {
        $page_info = $this->page_info();

        $rows = HomeSectionImage::select([
            'id',
            'alt',
            'image'
        ])->orderBy('pos')->get();

        return view('cms.pages.' . $page_info['link'] . '.order', compact('page_info', 'rows'));
    }

    /**
     * Update the order for all rows in the database
     *
     */
    public function orderSubmit(Request $request)
    {
        $page_info = $this->page_info();

        foreach ($request->id as $key => $id) {
            $row = HomeSectionImage::findOrFail($id);
            $row->pos = $request->pos[$key];
            $row->save();
        }

        return redirect()->route('admin.' . $page_info['link'] . '.index')->withStatus('Records successfully ordered.');
    }

}
