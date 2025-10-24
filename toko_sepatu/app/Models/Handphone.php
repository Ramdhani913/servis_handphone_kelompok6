<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Handphone extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'brand',
        'model',
        'release_year',
        'is_active',
        'image',
    ];

    
    public function service()
    {
        return $this->hasMany(Service::class, 'handphone_id');
    }
}
