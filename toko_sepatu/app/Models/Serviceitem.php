<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Serviceitem extends Model
{
use SoftDeletes;

  use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'is_active',
    ];

    protected $attributes = [
        'is_active' => 'active',
    ];
    protected $guarded = [];

  
    
    public function servicedetail()
    {
        return $this->hasMany(Servicedetail::class, 'serviceitem_id');
    }
}
