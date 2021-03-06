<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Form;
use App\Column;

class PageController extends Controller
{
    public $model;
    protected $table;
    protected $columns;
    protected $classname;

    public function __construct()
    {
        $this->model = new Page();
        $this->table = $this->model->getTable();
        $this->view = 'backend.default.';
        $this->classname = 'page';

        if(\View::exists('backend.page.index')){
            $this->view = 'backend.page.';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->columns = ['id','name','link', 'active','type'];

        $objects = Page::all();

        $form = new Form($this->columns, $this);
        return view($this->view.'index', ['classname' => $this->classname, 'fields' => $form->fields, 'objects' => $objects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->columns = ['name','link', 'active','text','type'];

        $form = new Form($this->columns, $this);
        return view($this->view.'create', ['classname' => $this->classname, 'fields' => $form->fields]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->columns = ['name','link', 'active','text','type'];

        foreach ($this->columns as $column) {
            $this->model->{$column} = $request->{$column};
        }
        $this->model->save();

        return redirect("/administrator/module/{$this->classname}");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $this->model = $page;
        $this->columns = ['name','link', 'active','type','text'];
        $form = new Form($this->columns, $this);
        return view($this->view.'edit', ['classname' => $this->classname, 'fields' => $form->fields, 'id' => $page->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->columns = ['name','link', 'active','text','type'];

        $model = ($this->model)->where('id', $id)->first();
        foreach ($this->columns as $column) {
            $model->{$column} = $request->{$column};
        }
        $model->save();

        return redirect("/administrator/module/{$this->classname}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ($this->model)->where('id', $id)->first();

        $model->delete();

        return redirect("/administrator/module/{$this->classname}");
    }
}
