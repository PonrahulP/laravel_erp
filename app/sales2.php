<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales2 extends Model
{
    protected $fillable = [
        'bill_no', 'product_code', 'product_name','quantity','unit_price','total','sales_type',
    ];
}
