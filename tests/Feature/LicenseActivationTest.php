<?php

use App\Models\License;
use Spatie\Activitylog\Models\Activity;

it('limits activations and logs events', function () {
    $license = License::factory()->create(['activation_limit' => 1]);

    $this->postJson('/api/licenses/activate', [
        'license_key' => $license->license_key,
    ])->assertOk();

    $this->postJson('/api/licenses/activate', [
        'license_key' => $license->license_key,
    ])->assertStatus(429);

    expect($license->activations()->count())->toBe(1);
    expect($license->events()->where('event', 'activated')->count())->toBe(1);
    expect(Activity::where('log_name', 'license')->count())->toBe(1);
});
