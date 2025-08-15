<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'author' => $this->faker->name(),
            'role' => $this->faker->jobTitle(),
            'quote' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1,5),
        ];
    }
}
