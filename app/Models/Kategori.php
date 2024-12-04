<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Kategori extends Model
{
    protected $table = 'kategori';
    public $timestamps = false;
    protected $fillable = ['nama_kategori'];
    protected $guarded = ['id']; 

    public function produk() {
        return $this->hasMany(Produk::class, 'kategori_id', 'id');
    }
}
