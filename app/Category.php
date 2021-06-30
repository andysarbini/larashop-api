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

}

