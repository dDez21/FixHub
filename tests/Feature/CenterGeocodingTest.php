<?php

namespace Tests\Feature;

use App\Jobs\GeocodeCenterJob;
use App\Models\Center;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class CenterGeocodingTest extends TestCase
{
    use RefreshDatabase;

    public function test_geocode_job_dispatched_on_center_create()
    {
        Bus::fake();

        $center = Center::create([
            'name' => 'Test Centro',
            'phone' => '0123456789',
            'address' => 'Via Test',
            'civic' => '1',
            'provincia' => 'Ancona',
            'region' => 'Marche',
            'country' => 'IT',
        ]);

        Bus::assertDispatched(GeocodeCenterJob::class);
    }
}
