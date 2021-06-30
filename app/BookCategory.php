<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquest\SoftDeletes;

class BookCategory extends Model
{
    //
    protected $table = 'book_category';
    protected $fillable = [
        'book_id', 'category_id', 'invoice_number', 'status'
    ];
}
