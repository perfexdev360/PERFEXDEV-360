<?php

namespace Database\Factories;

use App\Models\PipelineStage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PipelineStage>
 */
class PipelineStageFactory extends Factory
{
    protected $model = PipelineStage::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['New','Qualified','Proposal','Won','Lost']),
            'order' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
