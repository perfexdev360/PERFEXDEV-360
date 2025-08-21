<?php

namespace Database\Factories;

use App\Models\OrderReview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderReview>
 */
class OrderReviewFactory extends Factory
{
    protected $model = OrderReview::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
        ];
    }
}
