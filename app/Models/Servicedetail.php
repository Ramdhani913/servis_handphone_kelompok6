<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicedetail extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function serviceitem()
    {
        return $this->belongsTo(Serviceitem::class, 'serviceitem_id');
    }
}
