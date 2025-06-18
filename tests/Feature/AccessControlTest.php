<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessControlTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_cannot_access_staff_routes()
    {
        $cliente = User::factory()->create([
            'type' => 'client',
            'password' => bcrypt('password123'),
        ]);

        $this->actingAs($cliente);

        $response = $this->get('/staff/dashboard');

        $response->assertRedirect('/staff/login');
    }

    public function test_staff_cannot_access_client_routes()
    {
        $staffUser = User::factory()->create([
            'type' => 'staff',
            'password' => bcrypt('password123'),
        ]);

        $this->actingAs($staffUser);

        $response = $this->get('/client/dashboard');

        $response->assertRedirect('/client/login');
    }

    public function test_guest_cannot_access_staff_dashboard()
    {
        $response = $this->get('/staff/dashboard');
        $response->assertRedirect('/staff/login');
    }

    public function test_guest_cannot_access_client_dashboard()
    {
        $response = $this->get('/client/dashboard');
        $response->assertRedirect('/client/login');
    }
}
