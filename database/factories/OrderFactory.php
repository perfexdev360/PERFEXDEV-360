<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 50, 500);
        $tax = $subtotal * 0.1;
        return [
            'number' => $this->faker->unique()->numerify('O-####'),
            'currency' => 'USD',
            'subtotal' => $subtotal,
            'discount_total' => 0,
            'tax_total' => $tax,
            'grand_total' => $subtotal + $tax,
            'status' => 'paid',
            'billing_info' => [],
        ];
    }
}
