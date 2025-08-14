<?php

namespace Database\Factories;

use App\Models\ReleaseChannel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReleaseChannel>
 */
class ReleaseChannelFactory extends Factory
{
    protected $model = ReleaseChannel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['stable','beta','rc']),
        ];
    }
}
