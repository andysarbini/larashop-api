<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquest\SoftDeletes;

class Category extends Model
{
    //
    protected $table = 'categories';
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'slug', 'image', 'status'
    ];

    public function books() {
        return $this->belongsToMany("App\Book");

        // atau jika tabel tidak dalam bentuk singular yg sm dengan modelnya
        // return $this->belongsToMany('App\Book', 'book_category', 'category_id', 'book_id');
    }

}

