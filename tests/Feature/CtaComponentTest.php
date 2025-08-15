<?php

use App\Models\Setting;
use Database\Seeders\SettingSeeder;
use function Pest\Laravel\blade;
use function Pest\Laravel\seed;

it('seeds phone number and displays in CTA component', function () {
    seed(SettingSeeder::class);

    expect(Setting::where('key', 'cta_phone')->value('value'))
        ->toBe('03390123735');

    blade('<x-cta />')
        ->assertSee('03390123735');
});
