<?php

namespace Tests\Unit;

use App\Models\Produk;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ProdukTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_produk()
    {
        $user = User::create([
            'nama' => 'Test User',
            'email' => 'testuser@example.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567890',
            'password' => bcrypt('P@55word')
        ]);

        $kategori = Kategori::create(['nama_kategori' => 'Test Kategori']);

        $produk = Produk::create([
            'kategori_id' => $kategori->id,
            'user_id' => $user->id,
            'status' => 1,
            'nama_produk' => 'Test Produk',
            'detail' => 'Detail Produk',
            'harga' => 10000,
            'stok' => 10,
            'berat' => 1.5,
            'foto' => 'test.jpg'
        ]);

        $this->assertDatabaseHas('produk', [
            'nama_produk' => 'Test Produk',
        ]);
    }

    #[Test]
    public function it_can_update_a_produk()
    {
        $user = User::create([
            'nama' => 'Test User',
            'email' => 'testuser@example.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567890',
            'password' => bcrypt('P@55word')
        ]);

        $kategori = Kategori::create(['nama_kategori' => 'Test Kategori']);

        $produk = Produk::create([
            'kategori_id' => $kategori->id,
            'user_id' => $user->id,
            'status' => 1,
            'nama_produk' => 'Test Produk',
            'detail' => 'Detail Produk',
            'harga' => 10000,
            'stok' => 10,
            'berat' => 1.5,
            'foto' => 'test.jpg'
        ]);

        $produk->update(['nama_produk' => 'Updated Produk']);

        $this->assertDatabaseHas('produk', [
            'nama_produk' => 'Updated Produk',
        ]);
    }
    #[Test]
    public function it_can_delete_a_produk()
    {
        $user = User::create([
            'nama' => 'Test User',
            'email' => 'testuser@example.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567890',
            'password' => bcrypt('P@55word')
        ]);

        $kategori = Kategori::create(['nama_kategori' => 'Test Kategori']);

        $produk = Produk::create([
            'kategori_id' => $kategori->id,
            'user_id' => $user->id,
            'status' => 1,
            'nama_produk' => 'Test Produk',
            'detail' => 'Detail Produk',
            'harga' => 10000,
            'stok' => 10,
            'berat' => 1.5,
            'foto' => 'test.jpg'
        ]);

        $produk->delete();

        $this->assertDatabaseMissing('produk', [
            'nama_produk' => 'Test Produk',
        ]);
    }
}