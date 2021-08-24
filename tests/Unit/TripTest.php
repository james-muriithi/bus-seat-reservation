<?php

namespace Tests\Unit;

use App\Models\Trip;
use Tests\TestCase;

class TripTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_can_show_trip()
    {
        $trip = Trip::factory()->create();

        $this->json('get', route('admin.trips.show', $trip->id))
            ->assertStatus(200);
    }
}
