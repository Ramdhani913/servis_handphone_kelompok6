<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handphone extends Model
{
    protected $table = 'handphones'; // pastikan sama dengan nama tabel
    protected $fillable = ['nama', 'merek', 'tipe', 'stok', 'harga'];
}
