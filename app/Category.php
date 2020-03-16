<?php

namespace App;
use App\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function books()
    {
        return $this->hasMany('App\Book');
    }

    protected static function boot() {
        parent::boot();
    
        static::deleting(function($category) {
            Book::where('category_id',$category->id)
          ->update(['category_id' => null]);
        });
    }
}
