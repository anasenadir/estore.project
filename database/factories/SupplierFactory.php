<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'phone_number' => Str::substr(fake()->phoneNumber() , 0 , 15),
            'email' => Str::substr(fake()->email() , 0 , 25),
            'address' => Str::substr(fake()->address() ,0 , 50) 
        ];
    }
}
