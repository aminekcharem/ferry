<?php

namespace Tests\Feature;

use App\Models\ApplicationSetting;
use App\Models\User;
use App\Services\ApplicationSettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BackofficeSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_backoffice_settings_require_admin_access(): void
    {
        $this->get(route('backoffice.settings.edit'))
            ->assertRedirect(route('login', absolute: false));

        $this->actingAs(User::factory()->create())
            ->get(route('backoffice.settings.edit'))
            ->assertForbidden();
    }

    public function test_admin_can_update_notification_email_list(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->patch(route('backoffice.settings.update'), [
                'booking_notification_emails' => 'Sales@Example.com, manager@example.com, sales@example.com',
            ])
            ->assertRedirect(route('backoffice.settings.edit', absolute: false))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('application_settings', [
            'key' => ApplicationSettingService::BOOKING_NOTIFICATION_EMAILS,
            'value' => 'sales@example.com, manager@example.com',
        ]);
    }

    public function test_admin_must_enter_valid_comma_separated_email_addresses(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->from(route('backoffice.settings.edit'))
            ->patch(route('backoffice.settings.update'), [
                'booking_notification_emails' => 'sales@example.com, not-an-email',
            ])
            ->assertRedirect(route('backoffice.settings.edit', absolute: false))
            ->assertSessionHasErrors('booking_notification_emails');

        $this->assertDatabaseMissing('application_settings', [
            'key' => ApplicationSettingService::BOOKING_NOTIFICATION_EMAILS,
        ]);
    }

    public function test_admin_can_view_current_notification_email_list(): void
    {
        $admin = User::factory()->admin()->create();
        ApplicationSetting::create([
            'key' => ApplicationSettingService::BOOKING_NOTIFICATION_EMAILS,
            'value' => 'sales@example.com, manager@example.com',
        ]);

        $this->actingAs($admin)
            ->get(route('backoffice.settings.edit'))
            ->assertOk()
            ->assertSee('Backoffice settings')
            ->assertSee('sales@example.com, manager@example.com');
    }
}
