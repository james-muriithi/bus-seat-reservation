<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trip_id' => 'KKIEHD',
            'route_id' => 1,
            'fare' => 2000,
            'travel_date' => now(),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
