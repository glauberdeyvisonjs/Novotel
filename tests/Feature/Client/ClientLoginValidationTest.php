<?php

namespace Tests\Feature\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientLoginValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_and_password_are_required()
    {
        $response = $this->post('/client/login');

        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_email_must_be_a_valid_email()
    {
        $response = $this->post('/client/login', [
            'email' => 'email invalido',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_password_must_have_minimum_length()
    {
        $response = $this->post('/client/login', [
            'email' => 'client@example.com',
            'password' => 'passwor',
        ]);

        $response->assertSessionHasErrors('password');
    }
}
