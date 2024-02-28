<?php

namespace Database\Factories;

use App\Models\Campaigns;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leads>
 */
class LeadsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $email = fake()->email;
        $details = [
            "first_name" => fake()->firstName,
            "last_name" => fake()->lastName,
            "email" => $email,
            "phone" => fake()->phoneNumber,
            "country" => fake()->country,
            "state" => fake()->state(),
            "city" => fake()->city,
            "postal_code" => fake()->postcode
        ];

        return [
            'uuid' => Str::uuid(),
            "details" => $details,
            "campaigns_id" => Campaigns::all()->random()->uuid,
            "email"=>$email,
            "status" => random_int(0, 4)
        ];
    }
}
