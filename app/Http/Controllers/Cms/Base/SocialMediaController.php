<?php

namespace App\Http\Controllers\Cms\Base;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\FilesHelper;
use App\Models\SocialMedia;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:social_media-view', ['only' => ['index', 'show']]);
        $this->middleware('permission:social_media-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:social_media-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:social_media-publish', ['only' => ['publish']]);
        $this->middleware('permission:social_media-order', ['only' => ['order', 'orderSubmit']]);
    }

    public function page_info()
    {
        $page_info = [
            'title' => 'Social Media',
            'link' => 'social-media'
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

        $rows = SocialMedia::select([
            'id',
            'icon',
            'title',
            'link',
            'publish'
        ])->get();

        return view('cms.base.'.$page_info['link'].'.index', compact('page_info', 'rows'));
    }

    /**
     * Display a listing of the specified row
     *
     */
    public function show($id)
    {
        $page_info = $this->page_info();

        $row = SocialMedia::findOrFail($id);

        return view('cms.base.'.$page_info['link'].'.show', compact('page_info', 'row'));
    }

    /**
     * Show the form for creating a new row
     *
     */
    public function create()
    {
        $page_info = $this->page_info();

        return view('cms.base.'.$page_info['link'].'.create', compact('page_info'));
    }

    /**
     * Store a newly created row in the database
     *
     */
    public function store(Request $request)
    {
        $page_info = $this->page_info();

        $this->validate($request, [
            'icon' => 'required|mimes:png,jpg,jpeg,svg|max:500',
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255'
        ]);

        $icon_path = FilesHelper::storeFile($page_info['link'], $request->icon, $request->title);

        SocialMedia::create([
            'icon' => $icon_path,
            'title' => $request->title,
            'link' => $request->link,
            'publish' => $request->publish ? 1 : 0
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

        $row = SocialMedia::findOrFail($id);

        return view('cms.base.'.$page_info['link'].'.edit', compact('page_info', 'row'));
    }

    /**
     * Update the specified row in the database
     *
     */
    public function update(Request $request, $id)
    {
        $page_info = $this->page_info();

        $row = SocialMedia::findOrFail($id);

        $this->validate($request, [
            'icon' => 'mimes:png,jpg,jpeg,svg|max:500',
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255'
        ]);

        // Check if the icon exists
        $icon_path = $row->getAttributes()['icon'];
        if($request->icon){
            $icon_path = FilesHelper::storeFile($page_info['link'], $request->icon, $request->title);
        }

        $row->update([
            'icon' => $icon_path,
            'title' => $request->title,
            'link' => $request->link,
            'publish' => $request->publish ? 1 : 0
        ]);

        return redirect()->back()->withStatus('Record successfully updated.');
    }

    /**
     * Remove the specified row from the database
     *
     */
    public function destroy($id)
    {
        $row = SocialMedia::findOrFail($id);

        // Delete File
        $icon_path = public_path().$row->getAttributes()['icon'];
        FilesHelper::deleteFile($icon_path);

        $row->delete();

        return redirect()->back()->withStatus('Record successfully deleted.');
    }

    /**
     * Publish a specified row
     *
     */
    public function publish(Request $request)
    {
        $id = $request['id'];
        $row = SocialMedia::findOrFail($id);
        
        $row->update([
            'publish' => !$row->publish
        ]);
    }

    /**
     * Show the form for ordering all rows
     *
     */
    public function order()
    {
        $page_info = $this->page_info();

        $rows = SocialMedia::select([
            'id',
            'title'
        ])->get();

        return view('cms.base.'.$page_info['link'].'.order', compact('page_info', 'rows'));
    }

    /**
     * Update the order for all rows in the database
     *
     */
    public function orderSubmit(Request $request)
    {
        foreach($request->id as $key => $id) {
            $row = SocialMedia::findOrFail($id);
            $row->update([
                'pos' => $request->pos[$key]
            ]);
        }

        return redirect()->back()->withStatus('Records successfully ordered.');
    }

}
