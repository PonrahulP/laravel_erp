<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deposit extends Model
{
    protected $fillable = [
        'bank_name', 'amount', 'date',
    ];
}
