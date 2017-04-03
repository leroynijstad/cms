<?php

namespace App\Http\Controllers;

use App\Page;
use App\Module;
use App\Input;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $exceptions = [];
    protected $module;


    public function __construct(){

        $this->module = Module::where('name', 'page')->first();

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();

        $this->exceptions = ['text', 'created_at','updated_at'];

        $columns =  array_diff(\Schema::getColumnListing('pages'), $this->exceptions);

        return view('backend.page.index', compact('pages', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->exceptions = ['id', 'sequence'];
        $columns = $this->setupColumns();

        return view('backend.page.create',compact('columns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $page = new Page;
        $inputs = $request->only([
            'name', 'link', 'active', 'type','text'
        ]);
        foreach($inputs as $key => $value){
            $page->{$key} = $value;
        }
        $page->sequence = $page->max('sequence')+1;

        $page->save();

        return redirect('/administrator/module/page');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $this->exceptions = [];

        $columns = $this->setupColumns();

        $columns = $this->assignValues($columns, $page);

        return view('backend.page.edit',compact('columns', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $page->name = $request->name;
        $page->link = $request->link;
        $page->active = $request->active;
        $page->type = $request->type;
        $page->text = $request->text;
        $page->sequence = $request->sequence;

        $page->save();

        return redirect('/administrator/module/page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect('/administrator/module/page');
    }
}
