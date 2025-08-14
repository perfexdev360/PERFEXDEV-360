<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'company' => $this->faker->company(),
            'source' => $this->faker->randomElement(['contact','quote','project-brief','service-request']),
            'budget_min' => $this->faker->numberBetween(1000, 5000),
            'budget_max' => $this->faker->numberBetween(5000, 10000),
            'timeline' => $this->faker->word(),
            'tech_stack' => $this->faker->word(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
