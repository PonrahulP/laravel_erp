<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class balance extends Model
{
    protected $fillable = [
        'payment_type', 'amount', 
    ];
}
