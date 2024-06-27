<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categories;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Categories::class; public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'slug' => $this->faker->slug(),
            'meta_tag' => $this->faker->sentence(),
            'meta_keyword' => $this->faker->words(5, true),
            'meta_description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'authentication' => $this->faker->randomElement(['public', 'private']),
            'category_image' => null,
        ];
    }
}
