<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    protected $fillable = [
        'expenses_type', 'name', 'date','amount','payment_type',
    ];
}
