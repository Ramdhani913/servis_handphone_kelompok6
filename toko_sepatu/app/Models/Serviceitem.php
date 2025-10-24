<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serviceitem extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'service_name',
        'price',
        'is_active'
    ];
}
