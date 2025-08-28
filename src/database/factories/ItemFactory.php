<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->company(),
            'price' => $this->faker->randomNumber(5, true),
            'bland' => $this->faker->lastName(),
            'description' => $this->faker->realText(100),
            'image_url' => $this->faker->imageUrl(),
            // 'image' => $this->faker->imageUrl(),//
            'condition' => $this->faker->randomElement(['a', 'b', 'c', 'd']),
            'stock' => '1',
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
