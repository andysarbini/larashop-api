<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquest\SoftDeletes;

class BookOrder extends Model
{
    //
    protected $table = 'book_order';
    protected $fillable = [
        'book_id', 'order_id', 'quantity'
    ];
}
