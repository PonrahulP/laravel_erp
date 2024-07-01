<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class withdraw extends Model
{
    protected $fillable = [
        'bank_name', 'amount', 'date',
    ];
}
