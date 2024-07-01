<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supply extends Model
{
    protected $fillable = [
        'supplier_id', 'name', 'contact','address','email',
    ];
}
