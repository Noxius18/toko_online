<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Foto;

class Produk extends Model
{
    // Menetukan Nama Tabel yang digunakan
    protected $table = 'produk';
     // Menentukan atribut yang tidak dapat diisi secara massal
    protected $guarded = ['id'];
    // Menentukan bahwa model ini menggunakan timestamp
    public $timestamps = true;

    // Relasi ke model Kategori
    public function kategori() {
        // Mengembalikan relasi belongsTo dengan model Kategori
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    // Relasi ke model User
    public function user() { 
        // Mengembalikan relasi belongsTo dengan model User
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke model Foto
    public function fotoProduk() {
        // Mengembalikan relasi hasMany dengan model Foto
        return $this->hasMany(Foto::class, 'produk_id', 'id');
    }
}
