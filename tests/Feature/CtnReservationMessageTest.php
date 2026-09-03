<?php

namespace Tests\Feature;

use App\Mail\FerryReservationReceived;
use App\Models\ApplicationSetting;
use App\Models\CtnReservationMessage;
use App\Models\User;
use App\Services\ApplicationSettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CtnReservationMessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_send_ctn_reservation_message(): void
    {
        Mail::fake();

        $response = $this->post(route('reservation.ctn.store'), $this->validPayload());

        $response->assertRedirect(route('reservation.ctn', absolute: false));
        $response->assertSessionHas('status');
        $this->assertDatabaseHas('ctn_reservation_messages', [
            'customer_email' => 'client@example.com',
            'journey_type' => 'one_way',
            'favorite_ferry_company' => 'CTN',
            'return_country' => null,
            'return_date' => null,
        ]);
        $this->assertSame('2026-08-20', CtnReservationMessage::first()->outward_date->format('Y-m-d'));
        Mail::assertSent(FerryReservationReceived::class, function (FerryReservationReceived $mail): bool {
            return $mail->customerCopy
                && $mail->hasTo('client@example.com');
        });
    }

    public function test_embedded_reservation_page_hides_menu(): void
    {
        $this->get(route('reservation.ctn', ['embed' => 1]))
            ->assertOk()
            ->assertDontSee('Log in')
            ->assertDontSee('Ferry Booking')
            ->assertDontSee('Back to home')
            ->assertSee('reservation-ctn?embed=1', false);
    }

    public function test_embedded_reservation_submission_preserves_embed_parameter(): void
    {
        Mail::fake();

        $this->post(route('reservation.ctn.store', ['embed' => 1]), $this->validPayload())
            ->assertRedirect(route('reservation.ctn', ['embed' => 1, 'reservation_sent' => 1], absolute: false));
    }

    public function test_embedded_reservation_success_query_shows_confirmation_modal(): void
    {
        $this->get(route('reservation.ctn', ['embed' => 1, 'reservation_sent' => 1]))
            ->assertOk()
            ->assertSee('data-reservation-success-modal', false)
            ->assertSee('Your ferry reservation request has been sent.');
    }

    public function test_reservation_form_shows_required_field_markers(): void
    {
        $this->get(route('reservation.ctn'))
            ->assertOk()
            ->assertSee('Full name <span class="text-red-600" aria-hidden="true">*</span>', false)
            ->assertSee('Favorite ferry company <span class="text-red-600" aria-hidden="true">*</span>', false)
            ->assertSee('Departure country <span class="text-red-600" aria-hidden="true">*</span>', false)
            ->assertSee('name="trailer_length" type="number" step="0.01" min="0" value="2.90"', false)
            ->assertSee('name="trailer_height" type="number" step="0.01" min="0" value="1.41"', false)
            ->assertSee('name="trailer_width" type="number" step="0.01" min="0" value="0.00"', false)
            ->assertSee('Vehicle height confirmation')
            ->assertSee('I confirm that the vehicle height has been entered correctly. <span class="text-red-600" aria-hidden="true">*</span>', false);
    }

    public function test_reservation_honeypot_rejects_bot_submissions(): void
    {
        Mail::fake();

        $this->from(route('reservation.ctn'))
            ->post(route('reservation.ctn.store'), $this->validPayload([
                'booking_website' => 'https://spam.example',
            ]))
            ->assertRedirect(route('reservation.ctn', absolute: false))
            ->assertSessionHasErrors(['booking_website']);

        $this->assertDatabaseCount('ctn_reservation_messages', 0);
        Mail::assertNothingSent();
    }

    public function test_tampered_select_values_are_rejected(): void
    {
        Mail::fake();

        $this->from(route('reservation.ctn'))
            ->post(route('reservation.ctn.store'), $this->validPayload([
                'favorite_ferry_company' => 'SNCM',
                'has_roof_box' => '1',
                'has_roof_extra' => '1',
                'roof_extra_height' => '1.50',
                'has_back_extra' => '1',
                'back_extra_length' => '0.25',
                'has_trailer' => '1',
                'trailer_type' => 'Truck',
                'trailer_length' => '3.50',
                'trailer_width' => '1.80',
                'trailer_height' => '1.70',
            ]))
            ->assertRedirect(route('reservation.ctn', absolute: false))
            ->assertSessionHasErrors(['favorite_ferry_company', 'roof_extra_height', 'back_extra_length', 'trailer_type']);

        $this->assertDatabaseCount('ctn_reservation_messages', 0);
        Mail::assertNothingSent();
    }

    public function test_booking_notification_is_sent_to_configured_backoffice_recipients(): void
    {
        Mail::fake();
        ApplicationSetting::create([
            'key' => ApplicationSettingService::BOOKING_NOTIFICATION_EMAILS,
            'value' => 'sales@example.com, manager@example.com',
        ]);

        $this->post(route('reservation.ctn.store'), $this->validPayload())
            ->assertRedirect(route('reservation.ctn', absolute: false));

        Mail::assertSent(FerryReservationReceived::class, function (FerryReservationReceived $mail): bool {
            $html = $mail->render();

            return ! $mail->customerCopy
                && $mail->hasTo('sales@example.com')
                && $mail->hasTo('manager@example.com')
                && str_contains($html, 'Favorite ferry company')
                && str_contains($html, 'CTN');
        });
        Mail::assertSent(FerryReservationReceived::class, function (FerryReservationReceived $mail): bool {
            $html = $mail->render();

            return $mail->customerCopy
                && $mail->hasTo('client@example.com')
                && str_contains($html, 'Favorite ferry company')
                && str_contains($html, 'CTN');
        });
    }

    public function test_vehicle_extra_equipment_fields_are_stored(): void
    {
        Mail::fake();

        $this->post(route('reservation.ctn.store'), $this->validPayload([
            'vehicle_custom_dimensions' => '1',
            'vehicle_length' => '4.95',
            'vehicle_width' => '1.90',
            'vehicle_height' => '2.10',
            'has_roof_box' => '1',
            'has_roof_extra' => '1',
            'roof_extra_height' => '0.50',
            'has_back_extra' => '1',
            'back_extra_length' => '1.00',
        ]))->assertRedirect(route('reservation.ctn', absolute: false));

        $this->assertDatabaseHas('ctn_reservation_messages', [
            'customer_email' => 'client@example.com',
            'vehicle_custom_dimensions' => true,
            'vehicle_length' => '4.95',
            'vehicle_width' => '1.90',
            'vehicle_height' => '2.10',
            'has_roof_box' => true,
            'has_roof_extra' => true,
            'roof_extra_height' => '0.50',
            'has_back_extra' => true,
            'back_extra_length' => '1.00',
        ]);
    }

    public function test_reservation_submission_still_works_before_vehicle_extra_equipment_migration_runs(): void
    {
        Mail::fake();
        Schema::shouldReceive('hasColumn')
            ->with('ctn_reservation_messages', \Mockery::type('string'))
            ->andReturn(false);

        $this->post(route('reservation.ctn.store'), $this->validPayload([
            'vehicle_custom_dimensions' => '1',
            'vehicle_length' => '4.95',
            'vehicle_width' => '1.90',
            'vehicle_height' => '2.10',
            'has_roof_box' => '1',
            'has_roof_extra' => '1',
            'roof_extra_height' => '0.50',
            'has_back_extra' => '1',
            'back_extra_length' => '1.00',
        ]))->assertRedirect(route('reservation.ctn', absolute: false));

        $this->assertDatabaseHas('ctn_reservation_messages', [
            'customer_email' => 'client@example.com',
            'vehicle_length' => '4.95',
            'vehicle_width' => '1.90',
            'vehicle_height' => '2.10',
        ]);
    }

    public function test_round_trip_stores_return_country(): void
    {
        Mail::fake();

        $this->post(route('reservation.ctn.store'), $this->validPayload([
            'journey_type' => 'round_trip',
            'return_country' => 'Gênes - Tunisia',
            'return_date' => '2026-08-30',
            'return_passengers' => [1, 0, 0, 0, 0, 0],
        ]))->assertRedirect(route('reservation.ctn', absolute: false));

        $this->assertDatabaseHas('ctn_reservation_messages', [
            'customer_email' => 'client@example.com',
            'journey_type' => 'round_trip',
            'return_country' => 'Gênes - Tunisia',
        ]);

        $reservation = CtnReservationMessage::where('customer_email', 'client@example.com')->firstOrFail();

        $this->assertSame('2026-08-30', $reservation->return_date->format('Y-m-d'));
    }

    public function test_reservation_email_contains_all_submitted_form_sections(): void
    {
        $reservation = CtnReservationMessage::create($this->modelPayload([
            'journey_type' => 'round_trip',
            'favorite_ferry_company' => 'GNV',
            'return_country' => 'Gênes - Tunisia',
            'return_date' => '2026-08-30',
            'outward_passengers' => [1, 1, 0, 0, 0, 0],
            'return_passengers' => [1, 0, 1, 0, 0, 0],
            'passenger_details' => [
                'outward' => [
                    [
                        [
                            'last_name' => 'Passenger',
                            'first_name' => 'One',
                            'date_of_birth' => '1990-01-01',
                            'sexe' => 'male',
                            'passport_number' => 'P123456',
                            'passport_availability_date' => '2030-01-01',
                            'will_return' => 'no',
                            'return_replacement' => [
                                'last_name' => 'Return',
                                'first_name' => 'Passenger',
                                'date_of_birth' => '1992-02-02',
                                'sexe' => 'female',
                                'passport_number' => 'R654321',
                                'passport_availability_date' => '2031-02-02',
                            ],
                        ],
                    ],
                ],
            ],
            'vehicle_year' => 2024,
            'vehicle_custom_dimensions' => true,
            'vehicle_length' => '4.95',
            'vehicle_width' => '1.90',
            'vehicle_height' => '2.10',
            'has_roof_box' => true,
            'has_roof_extra' => true,
            'roof_extra_height' => '0.50',
            'has_back_extra' => true,
            'back_extra_length' => '1.00',
            'has_trailer' => true,
            'trailer_outward' => true,
            'trailer_return' => true,
            'trailer_type' => 'Caravan',
            'trailer_length' => '3.50',
            'trailer_width' => '1.80',
            'trailer_height' => '1.70',
            'trailer_license_number' => 'TR 456',
            'trailer_owner' => 'Trailer Owner',
        ]));

        $html = (new FerryReservationReceived($reservation))->render();

        $this->assertStringContainsString('Client CTN', $html);
        $this->assertStringContainsString('Favorite ferry company', $html);
        $this->assertStringContainsString('GNV', $html);
        $this->assertStringContainsString('Round trip', $html);
        $this->assertStringContainsString('Gênes - Tunisia', $html);
        $this->assertStringContainsString('Passenger quantities', $html);
        $this->assertStringContainsString('P123456', $html);
        $this->assertStringContainsString('Different return passenger', $html);
        $this->assertStringContainsString('R654321', $html);
        $this->assertStringContainsString('Toyota', $html);
        $this->assertStringContainsString('2024', $html);
        $this->assertStringContainsString('Extra on roof', $html);
        $this->assertStringContainsString('Extra roof height', $html);
        $this->assertStringContainsString('0.50', $html);
        $this->assertStringContainsString('Extra on back', $html);
        $this->assertStringContainsString('Extra back length', $html);
        $this->assertStringContainsString('1.00', $html);
        $this->assertStringContainsString('Caravan', $html);
        $this->assertStringContainsString('TR 456', $html);
        $this->assertStringContainsString('Height confirmation', $html);
    }

    public function test_customer_reservation_email_uses_confirmation_intro_and_hides_backoffice_link(): void
    {
        $reservation = CtnReservationMessage::create($this->modelPayload());

        $html = (new FerryReservationReceived($reservation, customerCopy: true))->render();

        $this->assertStringContainsString('Thank you for your request', $html);
        $this->assertStringContainsString('Thank you for submitting your ferry reservation request on Yesmintours.de.', $html);
        $this->assertStringContainsString('The Yesmin Tours team will review your request and contact you soon for validation.', $html);
        $this->assertStringContainsString('Client CTN', $html);
        $this->assertStringNotContainsString('Open in backoffice', $html);
    }

    public function test_reservation_email_infers_missing_return_country_for_round_trip(): void
    {
        $reservation = CtnReservationMessage::create($this->modelPayload([
            'journey_type' => 'round_trip',
            'departure_country' => 'Tunisia - Marseille',
            'return_country' => null,
            'return_date' => '2026-08-30',
            'return_passengers' => [1, 0, 0, 0, 0, 0],
        ]));

        $html = (new FerryReservationReceived($reservation))->render();

        $this->assertStringContainsString('Return country', $html);
        $this->assertStringContainsString('Marseille - Tunisia', $html);
    }

    public function test_reservation_email_lists_width_after_length_and_height(): void
    {
        $reservation = CtnReservationMessage::create($this->modelPayload([
            'vehicle_custom_dimensions' => true,
            'vehicle_length' => '4.95',
            'vehicle_width' => '1.90',
            'vehicle_height' => '2.10',
            'has_trailer' => true,
            'trailer_outward' => true,
            'trailer_type' => 'Caravan',
            'trailer_length' => '3.50',
            'trailer_width' => '1.80',
            'trailer_height' => '1.70',
        ]));

        $html = (new FerryReservationReceived($reservation))->render();
        $vehicleSection = substr($html, strpos($html, 'Custom dimensions'), strpos($html, 'Roof box') - strpos($html, 'Custom dimensions'));
        $trailerSection = substr($html, strpos($html, 'Trailer reservation'), strpos($html, 'License plate', strpos($html, 'Trailer reservation')) - strpos($html, 'Trailer reservation'));

        $this->assertLessThan(strpos($vehicleSection, 'Height'), strpos($vehicleSection, 'Length'));
        $this->assertLessThan(strpos($vehicleSection, 'Width'), strpos($vehicleSection, 'Height'));
        $this->assertLessThan(strpos($trailerSection, 'Height'), strpos($trailerSection, 'Length'));
        $this->assertLessThan(strpos($trailerSection, 'Width'), strpos($trailerSection, 'Height'));
    }

    public function test_empty_booking_notification_settings_disable_backoffice_email_notification(): void
    {
        Mail::fake();
        ApplicationSetting::create([
            'key' => ApplicationSettingService::BOOKING_NOTIFICATION_EMAILS,
            'value' => '',
        ]);

        $this->post(route('reservation.ctn.store'), $this->validPayload())
            ->assertRedirect(route('reservation.ctn', absolute: false));

        Mail::assertSent(FerryReservationReceived::class, 1);
        Mail::assertSent(FerryReservationReceived::class, function (FerryReservationReceived $mail): bool {
            return $mail->customerCopy
                && $mail->hasTo('client@example.com');
        });
    }

    public function test_passport_availability_date_must_be_after_today(): void
    {
        $this->travelTo('2026-08-22');

        $this->from(route('reservation.ctn'))
            ->post(route('reservation.ctn.store'), $this->validPayloadWithPassportDate('22/08/2026'))
            ->assertRedirect(route('reservation.ctn', absolute: false))
            ->assertSessionHasErrors(['passenger_details.outward.0.0.passport_availability_date']);

        $this->travelBack();
    }

    public function test_passport_availability_date_year_may_not_exceed_ten_years_after_current_year(): void
    {
        $this->travelTo('2026-08-22');

        $this->from(route('reservation.ctn'))
            ->post(route('reservation.ctn.store'), $this->validPayloadWithPassportDate('01/01/2037'))
            ->assertRedirect(route('reservation.ctn', absolute: false))
            ->assertSessionHasErrors(['passenger_details.outward.0.0.passport_availability_date']);

        $this->travelBack();
    }

    public function test_passport_availability_date_accepts_highest_allowed_year(): void
    {
        $this->travelTo('2026-08-22');

        $this->post(route('reservation.ctn.store'), $this->validPayloadWithPassportDate('31/12/2036'))
            ->assertRedirect(route('reservation.ctn', absolute: false))
            ->assertSessionHasNoErrors();

        $this->travelBack();
    }

    public function test_backoffice_ctn_reservations_requires_authentication(): void
    {
        $this->get(route('backoffice.ctn-reservations.index'))
            ->assertRedirect(route('login', absolute: false));
    }

    public function test_authenticated_user_can_view_ctn_reservation_messages(): void
    {
        $message = CtnReservationMessage::create($this->modelPayload([
            'customer_name' => 'Client CTN',
            'customer_email' => 'client@example.com',
        ]));

        $this->actingAs(User::factory()->create())
            ->get(route('backoffice.ctn-reservations.index'))
            ->assertOk()
            ->assertSee('Client CTN')
            ->assertSee('Favorite ferry company: CTN')
            ->assertSee('client@example.com');

        $this->actingAs(User::factory()->create())
            ->get(route('backoffice.ctn-reservations.show', $message))
            ->assertOk()
            ->assertSee('Client CTN')
            ->assertSee('Favorite ferry company')
            ->assertSee('CTN')
            ->assertSee('Message test');
    }

    public function test_opening_ctn_reservation_marks_it_as_viewed(): void
    {
        $message = CtnReservationMessage::create($this->modelPayload());

        $this->actingAs(User::factory()->create())
            ->get(route('backoffice.ctn-reservations.index'))
            ->assertOk()
            ->assertSee('New reservation', false);

        $this->actingAs(User::factory()->create())
            ->get(route('backoffice.ctn-reservations.show', $message))
            ->assertOk();

        $this->assertNotNull($message->fresh()->viewed_at);
    }

    public function test_authenticated_user_can_update_reservation_status_with_note(): void
    {
        $user = User::factory()->create(['name' => 'Agent CTN']);
        $message = CtnReservationMessage::create($this->modelPayload());

        $this->actingAs($user)
            ->patch(route('backoffice.ctn-reservations.update-status', $message), [
                'status' => 'reserved',
                'note' => 'Reservation confirmed with the customer.',
            ])
            ->assertRedirect(route('backoffice.ctn-reservations.show', $message, absolute: false));

        $this->assertDatabaseHas('ctn_reservation_messages', [
            'id' => $message->id,
            'status' => 'reserved',
        ]);
        $this->assertDatabaseHas('ctn_reservation_status_notes', [
            'ctn_reservation_message_id' => $message->id,
            'user_id' => $user->id,
            'from_status' => 'pending',
            'to_status' => 'reserved',
            'note' => 'Reservation confirmed with the customer.',
        ]);

        $this->actingAs($user)
            ->get(route('backoffice.ctn-reservations.show', $message))
            ->assertOk()
            ->assertSee('Reservation confirmed with the customer.')
            ->assertSee('Agent CTN');
    }

    public function test_backoffice_can_filter_reservations_by_received_date_and_status(): void
    {
        $pending = CtnReservationMessage::create($this->modelPayload([
            'customer_name' => 'Client Pending',
            'customer_email' => 'pending@example.com',
        ]));
        $pending->forceFill(['created_at' => '2026-08-10 09:00:00', 'updated_at' => '2026-08-10 09:00:00'])->save();

        $reserved = CtnReservationMessage::create($this->modelPayload([
            'customer_name' => 'Client Reserved',
            'customer_email' => 'reserved@example.com',
            'status' => 'reserved',
        ]));
        $reserved->forceFill(['created_at' => '2026-08-19 12:00:00', 'updated_at' => '2026-08-19 12:00:00'])->save();

        $this->actingAs(User::factory()->create())
            ->get(route('backoffice.ctn-reservations.index', [
                'date_from' => '18/08/2026',
                'date_to' => '20/08/2026',
                'status' => 'reserved',
            ]))
            ->assertOk()
            ->assertSee('Client Reserved')
            ->assertDontSee('Client Pending');
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'customer_name' => 'Client CTN',
            'customer_email' => 'client@example.com',
            'customer_phone' => '+216 22 333 444',
            'customer_message' => 'Message test',
            'journey_type' => 'one_way',
            'favorite_ferry_company' => 'CTN',
            'departure_country' => 'Tunisia - Gênes',
            'outward_date' => '2026-08-20',
            'outward_passengers' => [1, 0, 0, 0, 0, 0],
            'return_passengers' => [0, 0, 0, 0, 0, 0],
            'vehicle_brand' => 'Toyota',
            'vehicle_model' => 'Yaris',
            'vehicle_license_number' => '123 Tunis 456',
            'vehicle_owner' => 'Client CTN',
            'height_acceptance' => '1',
        ], $overrides);
    }

    private function validPayloadWithPassportDate(string $passportAvailabilityDate): array
    {
        return $this->validPayload([
            'passenger_details' => [
                'outward' => [
                    [
                        [
                            'last_name' => 'Passenger',
                            'first_name' => 'One',
                            'date_of_birth' => '01/01/1990',
                            'sexe' => 'male',
                            'passport_number' => 'P123456',
                            'passport_availability_date' => $passportAvailabilityDate,
                        ],
                    ],
                ],
            ],
        ]);
    }

    private function modelPayload(array $overrides = []): array
    {
        return array_merge($this->validPayload(), [
            'outward_date' => '2026-08-20',
            'return_passengers' => null,
            'vehicle_custom_dimensions' => false,
            'has_trailer' => false,
            'trailer_outward' => false,
            'trailer_return' => false,
            'height_acceptance' => true,
        ], $overrides);
    }
}
