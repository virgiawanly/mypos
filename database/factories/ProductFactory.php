<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $buyPrice = ($this->faker->randomNumber(2) + 1) * 500;
        $sellPrice = $buyPrice + $this->faker->randomElement([1000, 500]);

        return [
            'code' => $this->faker->ean13(),
            'name' => $this->faker->word(),
            'buy_price' => $buyPrice,
            'sell_price' => $sellPrice,
            'stock' => 0,
            'image' => $this->faker->imageUrl(),
            'info' => $this->faker->words(4, true),
            'category_id' => $this->faker->numberBetween(1, 50),
            'unit_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
