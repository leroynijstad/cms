<?php

namespace App\Http\Controllers;

use App\Column;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ResourceController extends Controller
{
    protected $_instance;
    protected $resource;
    protected $objects;
    protected $exceptions;
    protected $columns;

    public function __construct(Request $request, Route $route)
    {

        $this->resource['name'] = last(explode('/', $request->url()));
        $this->resource['path'] = "App\\".last(explode('/', $request->url()));
        $this->resource['parent'] = "App\Resource";
        $this->resource['action'] = last(explode('@', $route->getActionName()));

        if (!is_subclass_of($this->resource['path'], $this->resource['parent'])) {
            dd('test');
        }

        $this->_instance = new $this->resource['path'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->exceptions = ['text','created_at', 'updated_at'];
        // get that data to display
        $this->objects = $this->_instance->all();


        $this->columns = $this->getColumns();

        $this->assignValuesToColumns();

        return view('backend.module.index', [
            'modulename' => $this->resource['name'],
            'objects' => $this->objects,
            'columns' => $this->columns
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getColumns()
    {
        return array_diff(\Schema::getColumnListing($this->_instance->getTable()), $this->exceptions);
    }

    public function assignValuesToColumns()
    {

        foreach ($this->columns as $key => $value) {
            $this->columns[$value] = Column::
                where('table_name', $this->_instance->getTable())
                ->where('column_name', $value)
                ->first(['type']);

            unset($this->columns[$key]);
        }
    }
}
