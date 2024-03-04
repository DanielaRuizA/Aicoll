<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nit'=> fake()->randomNumber(8, true),
            'name'=> fake()->name(),
            'address'=> fake()->address(),
            'phone'=> fake()->randomNumber(5, true),
        ];
    }
}
