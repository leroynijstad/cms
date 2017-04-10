<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function album()
    {
        return $this->belongsTo(Album::class)->match();
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
