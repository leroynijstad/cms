<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Module;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $modules = Module::all();
        
        return view('backend.index', compact('modules'));
    }
}
