<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // settings
        if (Schema::hasTable('system_settings')) {
            // Cache::forget('settings');
            $settings = Cache::remember('settings', 24 * 60, function () {
                return SystemSetting::first();
            });

            if ($settings) {
                foreach (array_keys($settings->toArray()) as $key) {
                    Config::set('settings.' . $key, $settings[$key]);
                }
            }
        }
    }
}
