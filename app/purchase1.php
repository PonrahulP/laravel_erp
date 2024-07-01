<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase1 extends Model
{
    protected $fillable = [
        'supplier_id', 'bill_no', 'bill_img','purchase_date',
    ];
}
