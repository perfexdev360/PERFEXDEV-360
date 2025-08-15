<?php

namespace Database\Factories;

use App\Models\License;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<License>
 */
class LicenseFactory extends Factory
{
    protected $model = License::class;

    public function definition(): array
    {
        return [
            'license_key' => Str::upper(Str::random(16)),
            'type' => $this->faker->randomElement(['single','multi','enterprise']),
            'duration_days' => 365,
            'activation_limit' => 1,
            'update_window_ends_at' => now()->addYear(),
            'is_revoked' => false,
        ];
    }
}
