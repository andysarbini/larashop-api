<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquest\SoftDeletes;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id', 'total_price', 'invoice_number', 'status'
    ];
}
