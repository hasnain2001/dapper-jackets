<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true); // Generate a unique three-word name
        $slug = Str::slug($name); // Create a slug from the name
        
        return [
            'name' => $name,
            'slug' => $slug,
            'productimage' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'color' => $this->faker->colorName,
            'categories' => $this->faker->word,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']), // Corrected here
            'title' => $this->faker->sentence,
            'meta_tag' => $this->faker->sentence,
            'meta_keyword' => $this->faker->words(3, true),
            'meta_description' => $this->faker->paragraph,
        ];
    }
}
