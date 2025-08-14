<?php

namespace Database\Factories;

use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Version>
 */
class VersionFactory extends Factory
{
    protected $model = Version::class;

    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->semver(),
            'is_published' => true,
            'notes' => ['changelog' => $this->faker->sentence()],
            'forced_update' => false,
            'released_at' => now(),
        ];
    }
}
