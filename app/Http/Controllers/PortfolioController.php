<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{

	protected $albums;
	
    public function index($categorie = null) {

    	$this->albums = $this->getAlbums($categorie);
		return view('frontend.portfolio.index', ['albums' => $this->albums]);
		
	}  

	public function show(Album $album){

		if($this->getSubAlbums($album->id)->count()) {
			return view('frontend.portfolio.index', ['albums' => $this->albums]);
		}

		return view('frontend.portfolio.show', compact('album'));
		
	}
	
	public function getAlbums($categorie) {

		if($categorie){
			return $this->getCategorie($categorie);
		}

		return $this->albums = Album::isParent()->orderBy('id', 'desc')->get();

	}

	public function getSubAlbums($parent_id) {

		return $this->albums = Album::where('parent_id', $parent_id)->orderBy('id', 'desc')->get();
		
	}

	public function getCategorie($categorie) {

		return $this->albums = Album::where('tags','like','%'.$categorie.'%')->isParent()->orderBy('id', 'desc')->get();
				
	}
}
