<?php

namespace Tests\Feature;

use App\Mail\FerryReservationReceived;
use App\Models\CtnReservationMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
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
            'return_date' => null,
        ]);
        $this->assertSame('2026-08-20', CtnReservationMessage::first()->outward_date->format('Y-m-d'));
        Mail::assertSent(FerryReservationReceived::class, function (FerryReservationReceived $mail): bool {
            return $mail->hasTo('amine.kcharem@gmail.com')
                && $mail->reservation->customer_email === 'client@example.com';
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
            ->assertSee('client@example.com');

        $this->actingAs(User::factory()->create())
            ->get(route('backoffice.ctn-reservations.show', $message))
            ->assertOk()
            ->assertSee('Client CTN')
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
