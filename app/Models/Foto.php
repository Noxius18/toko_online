<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Foto extends Model
{
    protected $table = 'foto_produk';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
