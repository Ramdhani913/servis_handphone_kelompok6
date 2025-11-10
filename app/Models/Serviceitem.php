<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Serviceitem extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'service_name',
        'price',
        'is_active',
    ];

    protected $attributes = [
        'is_active' => 'active',
    ];

    public function servicedetail()
    {
        return $this->hasMany(Servicedetail::class, 'serviceitem_id');
    }
}
