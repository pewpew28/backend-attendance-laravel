<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'code' => strtoupper($this->faker->bothify('LOC-###')),
            'name' => $this->faker->company . ' Office',
            'address' => $this->faker->address,
        ];
    }
}
