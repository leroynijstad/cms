<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Form;
use App\Column;

class BannerController extends Controller
{
    public $model;
    protected $table;
    protected $columns;
    protected $view;
    protected $class;

    public function __construct()
    {
        $this->model = new Banner();
        $this->table = $this->model->getTable();
        $this->classname = 'banner';

        $this->view = 'backend.default.';
        if(\View::exists('backend.banner.index')){
            $this->view = 'backend.banner.';
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->columns = ['id','title','active', 'image','link', 'type'];

        $objects = Banner::all();

        $form = new Form($this->columns, $this);

        return view($this->view.'index', ['classname'=> $this->classname, 'fields' => $form->fields, 'objects' => $objects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->columns = ['title','active', 'image','link', 'type'];

        $form = new Form($this->columns, $this);
        return view($this->view.'create', ['classname'=> $this->classname, 'fields' => $form->fields]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->columns = ['title','active', 'image','link', 'type'];

        foreach ($this->columns as $column) {
            $this->model->{$column} = $request->{$column};
        }
        $this->model->save();

        return redirect("/administrator/module/banner");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $this->model = $banner;
        $this->columns = ['title','active', 'image','link', 'type'];
        $form = new Form($this->columns, $this);
        return view($this->view.'edit', ['classname'=> $this->classname, 'fields' => $form->fields, 'id' => $banner->id]);
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
        $this->columns = ['title','active', 'image','link', 'type'];

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
