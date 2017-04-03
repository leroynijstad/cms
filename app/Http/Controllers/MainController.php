<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Banner;

class MainController extends Controller {


	protected function home() {

		$banners['main'] = Banner::where('type', 'main')->get();
		$banners['main'][0]->first = true;
		$banners['small'] = Banner::where('type', 'small')->get();
		return view('frontend.statics.home', compact('banners'));
	}

	protected function show(Page $page) {


		if($page->count()) {
			return view("frontend.statics.{$page->link}");
		}
		

		return view("frontend.statics.home");


	}
	
}
