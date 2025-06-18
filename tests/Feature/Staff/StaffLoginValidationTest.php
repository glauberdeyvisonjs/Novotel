<?php

namespace Tests\Feature\Staff;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaffLoginValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_and_password_are_required()
    {
        $response = $this->post('/staff/login');

        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_email_must_be_a_valid_email()
    {
        $response = $this->post('/staff/login', [
            'email' => 'not-an-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_password_must_have_minimum_length()
    {
        $response = $this->post('/staff/login', [
            'email' => 'staff@example.com',
            'password' => 'passwor',
        ]);

        $response->assertSessionHasErrors('password');
    }
}
