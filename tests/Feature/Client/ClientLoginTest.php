<?php

namespace Feature\Client;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_login_with_correct_credentials()
    {
        User::factory()->create([
            'email' => 'client@example.com',
            'password' => bcrypt('password123'),
            'type' => 'client',
        ]);

        $response = $this->post('/client/login', [
            'email' => 'client@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/client/dashboard');
        $this->assertAuthenticated();
        $this->assertEquals('client', auth()->user()->type);
    }

    public function test_client_cannot_login_with_wrong_password()
    {
        User::factory()->create([
            'email' => 'client@example.com',
            'password' => bcrypt('password123'),
            'type' => 'client',
        ]);

        $response = $this->post('/client/login', [
            'email' => 'client@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['email' => 'Credenciais inválidas para client']);
        $this->assertGuest();
        $this->assertNull(auth()->user());
    }
}
