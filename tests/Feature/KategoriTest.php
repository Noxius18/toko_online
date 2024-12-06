<?php

namespace Tests\Unit;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_kategori()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Test Kategori']);

        $this->assertDatabaseHas('kategori', [
            'nama_kategori' => 'Test Kategori',
        ]);
    }

    #[Test]
    public function it_can_update_a_kategori()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Test Kategori']);

        $kategori->update(['nama_kategori' => 'Updated Kategori']);

        $this->assertDatabaseHas('kategori', [
            'nama_kategori' => 'Updated Kategori',
        ]);
    }

    #[Test]
    public function it_can_delete_a_kategori()
    {
        $kategori = Kategori::create(['nama_kategori' => 'Test Kategori']);

        $kategori->delete();

        $this->assertDatabaseMissing('kategori', [
            'nama_kategori' => 'Test Kategori',
        ]);
    }
}