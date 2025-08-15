<?php

namespace Database\Factories;

use App\Models\QuoteItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuoteItem>
 */
class QuoteItemFactory extends Factory
{
    protected $model = QuoteItem::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'qty' => 1,
            'unit_price' => $this->faker->randomFloat(2, 10, 100),
            'tax_rate' => $this->faker->randomFloat(2, 0, 20),
            'discount' => 0,
        ];
    }
}

