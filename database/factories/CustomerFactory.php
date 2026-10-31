<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Customer> */
class CustomerFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->numerify('+63 9## ### ####'),
        ];
    }
}
