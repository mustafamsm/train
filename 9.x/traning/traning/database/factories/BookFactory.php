<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence,
            'author'=>$this->faker->name,
            'publication' => $this->faker->date(),
            'category_id' => Category::all()->random()->id,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 0, 100),

        ];
    }
}
