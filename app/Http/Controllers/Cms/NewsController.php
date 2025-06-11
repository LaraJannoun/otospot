<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\FilesHelper;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:news-view', ['only' => ['index', 'show']]);
        $this->middleware('permission:news-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:news-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:news-publish', ['only' => ['publish']]);
    }

    public function page_info()
    {
        $page_info = [
            'title' => 'News',
            'link' => 'news'
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

        $rows = News::select([
            'id',
            'image',
            'title',
            'date',
            'publish'
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

        $row = News::findOrFail($id);

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
            'image' => 'required|mimes:png,jpg,jpeg,svg|max:500',
            'title' => 'required|string|max:255',
            'text' => 'required',
            'date' => 'required'
        ]);

        $image_path = FilesHelper::storeFile($page_info['link'], $request->image, $request->title);

        News::create([
            'image' => $image_path,
            'title' => $request->title,
            'text' => $request->text,
            'date' => $request->date,
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

        $row = News::findOrFail($id);

        return view('cms.pages.'.$page_info['link'].'.edit', compact('page_info', 'row'));
    }

    /**
     * Update the specified row in the database
     *
     */
    public function update(Request $request, $id)
    {
        $page_info = $this->page_info();

        $row = News::findOrFail($id);

        $this->validate($request, [
            'image' => 'mimes:png,jpg,jpeg,svg|max:500',
            'title' => 'required|string|max:255',
            'text' => 'required',
            'date' => 'required'
        ]);

        // Check if the icon exists
        $image_path = $row->getAttributes()['image'];
        if($request->image){
            $image_path = FilesHelper::storeFile($page_info['link'], $request->image, $request->title);
        }

        $row->update([
            'image' => $image_path,
            'title' => $request->title,
            'text' => $request->text,
            'date' => $request->date,
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
        $row = News::findOrFail($id);

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
        $row = News::findOrFail($id);

        $row->update([
            'publish' => !$row->publish
        ]);
    }

}
