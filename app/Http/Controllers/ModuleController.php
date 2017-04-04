<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{


    public function __construct(Request $request){
    	$this->modules = Module::all();

    	$url = explode('/', $request->path());
    	$this->class = new $this->classname;
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
    public function setupColumns() {
        $columns = array_map(
            array($this, 'checkEnum'), 
            Input::where('table_name', 'pages')->get()->toArray()
        );

        foreach( $columns as $key => $value ){

            if(in_array($value['column_name'], $this->exceptions)){
                unset($columns[$key]);
            }
        }
        return $columns;
    }

    protected function checkEnum($column){
        if($column['type'] === 'select'){
            $column['default_values'] = $this->convertEnum($column['column_name']);
        }else{
            $column['column_name'];
        }

        $column['value'] = '';

        return $column;
    }

    protected function convertEnum($column){

        $type = \DB::select(\DB::raw("SHOW COLUMNS FROM pages WHERE Field = '{$column}'"))[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value ) {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }
        return $enum;
    }

    protected function assignValues($columns, Page $page){

        $nr = 0;
        foreach($columns as $column){
            $columnname = $column['column_name'];
            $column['value'] = $page->$columnname;
            $columns[$nr] =  $column;
            $nr++;
        }
        
        return $columns;
    }
  
}
