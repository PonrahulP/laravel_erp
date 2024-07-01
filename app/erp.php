<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class erp extends Model
{
    protected $fillable = [
        'username', 'password', 'email','contact','role','openbank','opencash','logo',
    ];
}
