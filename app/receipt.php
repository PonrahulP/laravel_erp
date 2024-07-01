<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipt extends Model
{
    protected $fillable = [
        'bill_no', 'date', 'total_amount','amount','pending_amount','payment_type',
    ];
}
