<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Quote>
 */
class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 100, 1000);
        $tax = $subtotal * 0.2;
        return [
            'number' => $this->faker->unique()->numerify('Q-####'),
            'status' => $this->faker->randomElement(['draft','sent','approved']),
            'valid_until' => now()->addDays(30),
            'subtotal' => $subtotal,
            'discount_total' => 0,
            'tax_total' => $tax,
            'grand_total' => $subtotal + $tax,
        ];
    }
}
