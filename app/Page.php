<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{	

    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    
}
