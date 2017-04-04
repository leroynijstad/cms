<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class AdminController extends Controller {

	public function __construct() {

		$this->middleware('auth');

	}

	public function dashboard(){

		$modules = Module::all();
		
		return view('backend.index', compact('modules'));

	}
}
