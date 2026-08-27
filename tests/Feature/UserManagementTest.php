<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_management_requires_admin_access(): void
    {
        $this->get(route('backoffice.users.index'))
            ->assertRedirect(route('login', absolute: false));

        $this->actingAs(User::factory()->create())
            ->get(route('backoffice.users.index'))
            ->assertForbidden();
    }

    public function test_admin_can_create_user_account(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->post(route('backoffice.users.store'), [
                'name' => 'Reservation Agent',
                'email' => 'agent@example.com',
                'password' => 'Secure123',
                'password_confirmation' => 'Secure123',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('users', [
            'name' => 'Reservation Agent',
            'email' => 'agent@example.com',
            'is_admin' => false,
        ]);

        $this->post('/login', [
            'email' => 'agent@example.com',
            'password' => 'Secure123',
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticated();
    }

    public function test_admin_can_view_user_management_pages(): void
    {
        $admin = User::factory()->admin()->create();
        $agent = User::factory()->create(['name' => 'Reservation Agent']);

        $this->actingAs($admin)
            ->get(route('backoffice.users.index'))
            ->assertOk()
            ->assertSee('Users')
            ->assertSee('Reservation Agent');

        $this->actingAs($admin)
            ->get(route('backoffice.users.create'))
            ->assertOk()
            ->assertSee('Add user');

        $this->actingAs($admin)
            ->get(route('backoffice.users.edit', $agent))
            ->assertOk()
            ->assertSee('Edit user')
            ->assertSee('Reservation Agent');
    }

    public function test_admin_can_update_user_and_grant_admin_access(): void
    {
        $admin = User::factory()->admin()->create();
        $agent = User::factory()->create(['email' => 'agent@example.com']);

        $this->actingAs($admin)
            ->patch(route('backoffice.users.update', $agent), [
                'name' => 'Senior Agent',
                'email' => 'senior@example.com',
                'password' => 'Newsecure123',
                'password_confirmation' => 'Newsecure123',
                'is_admin' => '1',
            ])
            ->assertRedirect(route('backoffice.users.edit', $agent, absolute: false));

        $this->assertDatabaseHas('users', [
            'id' => $agent->id,
            'name' => 'Senior Agent',
            'email' => 'senior@example.com',
            'is_admin' => true,
        ]);
    }

    public function test_admin_cannot_remove_their_own_admin_access(): void
    {
        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $this->actingAs($admin)
            ->patch(route('backoffice.users.update', $admin), [
                'name' => 'Admin',
                'email' => 'admin@example.com',
            ])
            ->assertSessionHasErrors('is_admin');

        $this->assertTrue($admin->fresh()->is_admin);
    }

    public function test_admin_can_delete_another_user(): void
    {
        $admin = User::factory()->admin()->create();
        $agent = User::factory()->create();

        $this->actingAs($admin)
            ->delete(route('backoffice.users.destroy', $agent))
            ->assertRedirect(route('backoffice.users.index', absolute: false));

        $this->assertModelMissing($agent);
    }
}
