<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_first_user_can_register_as_admin_and_is_authenticated(): void
    {
        $response = $this->post('/register', [
            'name' => 'Amina Ferry',
            'email' => 'amina@example.com',
            'password' => 'Secure123',
            'password_confirmation' => 'Secure123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'amina@example.com',
            'is_admin' => true,
        ]);
    }

    public function test_registration_is_closed_after_first_user_exists(): void
    {
        User::factory()->create();

        $this->get('/register')->assertNotFound();

        $this->post('/register', [
            'name' => 'Second User',
            'email' => 'second@example.com',
            'password' => 'Secure123',
            'password_confirmation' => 'Secure123',
        ])->assertNotFound();
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        User::factory()->create([
            'email' => 'captain@example.com',
            'password' => 'Secure123',
        ]);

        $response = $this->post('/login', [
            'email' => 'captain@example.com',
            'password' => 'Secure123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_password(): void
    {
        User::factory()->create([
            'email' => 'captain@example.com',
            'password' => 'Secure123',
        ]);

        $response = $this->post('/login', [
            'email' => 'captain@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }
}
