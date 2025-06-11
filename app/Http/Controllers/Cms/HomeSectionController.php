<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\HomeSection;

class HomeSectionController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // function __construct()
    // {
    //     $this->middleware('permission:home_sections-view', ['only' => ['index', 'show']]);
    //     $this->middleware('permission:home_sections-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:home_sections-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:home_sections-delete', ['only' => ['destroy']]);
    // }

    public function page_info()
    {
        $page_info = [
            'title' => 'Home Sections',
            'link' => 'home-sections',
            'table_name' => 'home_sections'
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

        $rows = HomeSection::select([
            'id',
            'slug',
            'title_en',
            'title_ar',
            'subtitle_en',
            'subtitle_ar',
            'text_en',
            'text_ar',
        ])->get();

        return view('cms.pages.'.$page_info['link'].'.index', compact('page_info', 'rows'));
    }

    /**
     * Display a listing of the specified row
     *
     */
    public function show($id)
    {
        $page_info = $this->page_info();

        $row = HomeSection::findOrFail($id);

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
            'slug' => 'required|unique:'.$page_info['table_name'],
            'title_en' => 'required|string|max:255',
            'text_en' => 'required'
        ]);

        HomeSection::create([
            'slug' => $request->slug,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'subtitle_en' => $request->subtitle_en,
            'subtitle_ar' => $request->subtitle_ar,
            'text_en' => $request->text_en,
            'text_ar' => $request->text_ar
        ]);

        return redirect()->route('admin.'.$page_info['link'].'.index')->withStatus('Record successfully created.');
    }

    /**
     * Show the form for editing the specified row
     *
     */
    public function edit($id)
    {
        $page_info = $this->page_info();

        $row = HomeSection::findOrFail($id);

        return view('cms.pages.'.$page_info['link'].'.edit', compact('page_info', 'row'));
    }

    /**
     * Update the specified row in the database
     *
     */
    public function update(Request $request, $id)
    {
        $row = HomeSection::findOrFail($id);

        $this->validate($request, [
            'title_en' => 'required|string|max:255',
            'text_en' => 'required'
        ]);

        $row->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'subtitle_en' => $request->subtitle_en,
            'subtitle_ar' => $request->subtitle_ar,
            'text_en' => $request->text_en,
            'text_ar' => $request->text_ar,
        ]);

        return redirect()->back()->withStatus('Record successfully updated.');
    }

    /**
     * Remove the specified row from the database
     *
     */
    public function destroy($id)
    {
        HomeSection::findOrFail($id)->delete();

        return redirect()->back()->withStatus('Record successfully deleted.');
    }

}
