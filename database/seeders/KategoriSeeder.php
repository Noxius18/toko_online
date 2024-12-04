<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [
            'Brownies',
            'Combro',
            'Dawet',
            'Mochi',
            'Wingko'
        ];
        
        foreach ($list as $kategori) {
            Kategori::create([
                'nama_kategori' => $kategori
            ]);
        }


    }
}
