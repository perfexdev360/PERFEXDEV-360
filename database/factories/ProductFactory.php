<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'type' => $this->faker->randomElement(['ERP', 'Module']),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'summary' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'seo' => ['title' => $name, 'description' => $this->faker->sentence()],
            'is_active' => true,
        ];
    }
}
