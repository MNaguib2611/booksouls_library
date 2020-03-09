<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function favourites()
    {
        return $this->hasMany('App\Favourite');
    }

    public function leases()
    {
        return $this->hasMany('App\Lease');
    }

    
}
