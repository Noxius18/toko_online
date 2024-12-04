<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\User;

class Produk extends Model
{
    protected $table = 'produk';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function user() { 
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
