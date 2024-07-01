<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase2 extends Model
{
    protected $fillable = [
        'bill_no', 'product_code', 'product_name','quantity','unit_price','cgst','sgst','total',
    ];
}
