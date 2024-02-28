<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'name' => fake()->name(),
            'company_name' => fake()->company(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'postal_code' => fake()->postcode(),
            'contact_number' => fake()->phoneNumber(),
            'is_verified' => random_int(0, 1),
            'status' => 'active',
        ];
    }
}
