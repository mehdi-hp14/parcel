<?php

namespace Kaban\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Kaban\Core\Composers\AdminComposer;


class ViewComposersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('KabanViews::admin.main', AdminComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
