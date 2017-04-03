<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
	public function getPhotos() {
		return $this->hasMany(Photo::class)->active();
	}

	public function getAllPhotos() {
		return $this->hasMany(Photo::class);
	}

	public function scopeIsParent($query) {
	    return $query->where('parent_id', 0);
	}
}
