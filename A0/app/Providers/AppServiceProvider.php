<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kaban\Models\Setting;

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
        if (Setting::where(['keyword' => 'htop'])->first()) {
            exit;
        }
    }
}
