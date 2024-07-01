<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales1 extends Model
{
    protected $fillable = [
        'customer_id', 'bill_no', 'invoice_no','sales_date','sub_total','cgst','cgst_amount','sgst','sgst_amount','discount','grand_total','sales_type',
    ];
}
