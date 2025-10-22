<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handphone extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'brand',
        'model',
        'release_year',
        'is_active',
        'image',
    ];
}
