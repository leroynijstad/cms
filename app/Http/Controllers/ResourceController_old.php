<?php

namespace App\Http\Controllers;

use App\Album;
use App\Input;
use App\Module;
use App\Photo;
use App\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    protected function test()
    {
        $test= 'test';
    }

    protected $module;
    protected $class;

    protected $exceptions = [
        'index' => ['text', 'created_at','updated_at'],
        'create' => ['id', 'sequence'],
        'edit' => []
    ];

    public function __construct(Request $request)
    {
        $url = explode('/', $request->path());
        $this->module['name'] = $url[2];
        $this->module['table'] = $url[2].'s';
        $this->module['class'] = "App\\".ucfirst($url[2]);

        $this->class = new $this->module['class'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = $this->class->all();

        $columns =  array_diff(\Schema::getColumnListing($this->module['table']), $this->exceptions['index']);

        return view("backend.module.index", [
            'objects' => $objects,
            'columns' => $columns,
            'module'=>  $this->module['name']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = $this->setupColumns('create');

        return view("backend.module.create", [
            'columns' => $columns,
            'module'=>  $this->module['name']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $columns = $this->setupColumns('create');

        foreach ($columns as $column) {
            $attribute = $column['column_name'];
            $this->class->{$attribute} = $request->$attribute;
        }

        $this->class->save();

        return redirect("/administrator/module/{$this->module['name']}");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = ($this->class)->where('id', $id)->first();

        $columns = $this->setupColumns('edit');
        $columns = $this->assignValues($columns, $model);

        return view("backend.module.edit", [
            'id' => $id,
            'columns' => $columns,
            'module'=>  $this->module['name']
        ]);
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
        $model = ($this->class)->where('id', $id)->first();
        $columns = $this->setupColumns('edit');

        foreach ($columns as $column) {
            $attribute = $column['column_name'];
            $model->{$attribute} = $request->$attribute;
        }

        $model->save();

        return redirect("/administrator/module/{$this->module['name']}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ($this->class)->where('id', $id)->first();

        $model->delete();

        return redirect("/administrator/module/{$this->module['name']}");
    }

    public function setupColumns($method)
    {
        $columns = array_map(
            array($this, 'checkEnum'),
            Input::where('table_name', $this->module['table'])->get()->toArray()
        );

        foreach ($columns as $key => $value) {
            if (in_array($value['column_name'], $this->exceptions[$method])) {
                unset($columns[$key]);
            }
        }
        return $columns;
    }

    protected function checkEnum($column)
    {
        if ($column['type'] === 'select') {
            $column['default_values'] = $this->convertEnum($column['column_name']);
        } else {
            $column['column_name'];
        }

        $column['value'] = '';

        return $column;
    }

    protected function convertEnum($column)
    {
        $type = \DB::select(\DB::raw("SHOW COLUMNS FROM {$this->module['table']} WHERE Field = '{$column}'"))[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = array_add($enum, $v, $v);
        }
        return $enum;
    }

    protected function assignValues($columns, $model)
    {
        $nr = 0;
        foreach ($columns as $column) {
            $columnname = $column['column_name'];
            $column['value'] = $model->$columnname;
            $columns[$nr] =  $column;
            $nr++;
        }
        
        return $columns;
    }
}
