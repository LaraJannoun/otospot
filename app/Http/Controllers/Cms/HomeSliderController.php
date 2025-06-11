<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Storage;

class HomeSliderController extends Controller
{

    public function page_info()
    {
        $page_info = [
            'title' => 'Home Sliders',
            'link' => 'home-sliders',
            'table_name' => 'home_sliders'
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

        $rows = HomeSlider::select([
            'id',
            'slug',
            'image',
            'title_en',
            'title_ar',
            'subtitle_en',
            'subtitle_ar',
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

        $row = HomeSlider::findOrFail($id);

        return view('cms.pages.'.$page_info['link'].'.show', compact('page_info', 'row'));
    }

    /**
     * Show the form for creating a new row
     *
     */
    public function create()
    {
        $page_info = $this->page_info();

        return view('cms.pages.'.$page_info['link'].'.create', compact('page_info'));
    }

    /**
     * Store a newly created row in the database
     *
     */
    public function store(Request $request)
    {
        $page_info = $this->page_info();

        $this->validate($request, [
            'slug' => 'required|unique:'.$page_info['table_name']
        ]);

        $image_path = null;
        if($request->image){
            $this->validate($request, [
                'image' => 'required|mimes:mp4,mov,ogg,qt,png,jpg,jpeg'
            ]);
            $image_path = parent::store_file($page_info['link'], $request->image);
        }

        $row = new HomeSlider;
        $row->slug = $request->slug;
        $row->image = $image_path;
        $row->title_en = $request->title_en;
        $row->title_ar = $request->title_ar;
        $row->subtitle_en = $request->subtitle_en;
        $row->subtitle_ar = $request->subtitle_ar;
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

        $row = HomeSlider::findOrFail($id);

        return view('cms.pages.'.$page_info['link'].'.edit', compact('page_info', 'row'));
    }

    /**
     * Update the specified row in the database
     *
     */
    public function update(Request $request, $id)
    {
        $page_info = $this->page_info();

        $row = HomeSlider::findOrFail($id);

        // Check if the image exists
        $image_path = $row['image'];
        if($request->image){
            $this->validate($request, [
                'image' => 'required|mimes:mp4,mov,ogg,qt,png,jpg,jpeg'
            ]);
            $image_path = parent::store_file($page_info['link'], $request->image);
        }
        
        $row->image = $image_path;
        $row->slug = $request->slug;
        $row->title_en = $request->title_en;
        $row->title_ar = $request->title_ar;
        $row->subtitle_en = $request->subtitle_en;
        $row->subtitle_ar = $request->subtitle_ar;

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

        HomeSlider::findOrFail($id)->delete();

        return redirect()->route('admin.'.$page_info['link'].'.index')->withStatus('Record successfully deleted.');
    }

    /**
     * Remove Brochure function
     *
     */
    public function imageRemove($id)
    {
        $page_info = $this->page_info();

        $row = HomeSlider::findOrFail($id);
        $row->image = null;
        $row->save();

        return redirect()->route('admin.'.$page_info['link'].'.index')->withStatus('Record successfully deleted.');
    }

    public function publish(Request $request)
    {
        $id = $request['id'];
        $row = HomeSlider::findOrFail($id);
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

        $rows = HomeSlider::select([
            'id',
            'title_en',
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
            $row = HomeSlider::findOrFail($id);
            $row->pos = $request->pos[$key];
            $row->save();
        }

        return redirect()->route('admin.' . $page_info['link'] . '.index')->withStatus('Records successfully ordered.');
    }

}
