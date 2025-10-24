<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serviceitem extends Model
{
use SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'service_name',
        'price',
        'is_active'
    ];

    
    public function servicedetail()
    {
        return $this->hasMany(Servicedetail::class, 'serviceitem_id');
    }
}
