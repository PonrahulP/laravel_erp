<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'bill_no', 'date', 'total_amount','amount','pending_amount','payment_type',
    ];
}
