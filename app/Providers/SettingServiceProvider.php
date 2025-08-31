<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (! config('app.installed')) {
            return;
        }

        if (Schema::hasTable('settings')) {
            $settings = Setting::pluck('value', 'key')->toArray();
            $config = [];
            foreach ($settings as $key => $value) {
                Arr::set($config, $key, $value);
            }
            config(['settings' => $config]);
            if (isset($config['app']['timezone'])) {
                config(['app.timezone' => $config['app']['timezone']]);
            }
        }
    }
}
