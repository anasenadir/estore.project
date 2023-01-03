<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => fake()->numberBetween(3,9) ,
            'name' => fake()->name(),
            'quatity' => fake()->numberBetween(1000, 2000)  ,
            'buy_price' => fake()->randomFloat(2 , 500 , 3000),
            'sell_price' => fake()->randomFloat(2 , 500 , 3000) ,
            'unit' => fake()->numberBetween(1, 2) ,
            'product_code' => Str::random(20)
        ];
    }
}
