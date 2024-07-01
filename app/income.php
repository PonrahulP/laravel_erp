<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class income extends Model
{
    protected $fillable = [
        'name', 'date', 'amount','payment_type',
    ];
}
