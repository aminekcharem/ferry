<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class VehicleSpecificationTest extends TestCase
{
    public function test_dimensions_are_returned_in_metres_for_the_selected_model_year(): void
    {
        Cache::flush();
        Http::fake([
            'https://vpic.nhtsa.dot.gov/*' => Http::response([
                'Results' => [[
                    'Specs' => [
                        ['Name' => 'Model', 'Value' => 'GOLF 4DR HATCH'],
                        ['Name' => 'OL', 'Value' => '425'],
                        ['Name' => 'OW', 'Value' => '180'],
                        ['Name' => 'OH', 'Value' => '145'],
                    ],
                ]],
            ]),
        ]);

        $this->getJson(route('vehicle-specifications.dimensions', [
            'brand' => 'Volkswagen',
            'model' => 'Golf 7',
            'year' => 2018,
        ]))
            ->assertOk()
            ->assertJsonPath('source_model', 'GOLF 4DR HATCH')
            ->assertJsonPath('dimensions.length', 4.25)
            ->assertJsonPath('dimensions.width', 1.8)
            ->assertJsonPath('dimensions.height', 1.45);
    }

    public function test_invalid_vehicle_year_is_rejected(): void
    {
        $this->getJson(route('vehicle-specifications.dimensions', [
            'brand' => 'Volkswagen',
            'model' => 'Golf',
            'year' => 1960,
        ]))
            ->assertUnprocessable()
            ->assertJsonValidationErrors('year');
    }
}
