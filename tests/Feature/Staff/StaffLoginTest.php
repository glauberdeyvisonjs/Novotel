<?php

namespace Feature\Staff;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaffLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_can_login_with_correct_credentials()
    {
        User::factory()->create([
            'email' => 'staff@example.com',
            'password' => bcrypt('password123'),
            'type' => 'staff',
        ]);

        $response = $this->post('/staff/login', [
            'email' => 'staff@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/staff/dashboard');
        $this->assertAuthenticated();
        $this->assertEquals('staff', auth()->user()->type);
    }

    public function test_staff_cannot_login_with_wrong_password()
    {
        User::factory()->create([
            'email' => 'staff@example.com',
            'password' => bcrypt('password123'),
            'type' => 'staff',
        ]);

        $response = $this->post('/staff/login', [
            'email' => 'staff@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['email' => 'Credenciais inválidas para staff']);
        $this->assertGuest();
        $this->assertNull(auth()->user());
    }
}
