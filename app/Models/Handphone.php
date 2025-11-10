<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
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
=======

class Handphone extends Model
{
    protected $table = 'handphones'; // pastikan sama dengan nama tabel
    protected $fillable = ['nama', 'merek', 'tipe', 'stok', 'harga'];
>>>>>>> 0cdab11c69774ac7f57a244149b56b3da6621235
}
