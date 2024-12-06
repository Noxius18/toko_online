<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_user()
    {
        $user = User::create([
            'nama' => 'Test User',
            'email' => 'testuser@example.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567890',
            'password' => bcrypt('P@55word')
        ]);

        $this->assertDatabaseHas('user', [
            'email' => 'testuser@example.com',
        ]);
    }

    #[Test]
    public function it_can_update_a_user()
    {
        $user = User::create([
            'nama' => 'Test User',
            'email' => 'testuser@example.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567890',
            'password' => bcrypt('P@55word')
        ]);

        $user->update(['nama' => 'Updated User']);

        $this->assertDatabaseHas('user', [
            'nama' => 'Updated User',
        ]);
    }

    #[Test]
    public function it_can_delete_a_user()
    {
        $user = User::create([
            'nama' => 'Test User',
            'email' => 'testuser@example.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567890',
            'password' => bcrypt('P@55word')
        ]);

        $user->delete();

        $this->assertDatabaseMissing('user', [
            'email' => 'testuser@example.com',
        ]);
    }
}