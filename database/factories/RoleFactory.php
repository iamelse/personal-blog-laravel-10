<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->jobTitle,
            'guard_name' => $this->faker->randomElement(['web', 'api']),
            'created_at' => Carbon::now()->subDays(random_int(1, 365)),
            'updated_at' => Carbon::now()->subDays(random_int(1, 365))
        ];
    }
}
