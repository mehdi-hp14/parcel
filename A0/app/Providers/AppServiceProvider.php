<?php

namespace App\Providers;

use Illuminate\Filesystem\Cache;
use Illuminate\Support\ServiceProvider;
use Kaban\Models\MailConfig;

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
        $mailConfig = \Cache::get('mailConfig');

        if($mailConfig)
        $this->app['config']['mail'] = [
            'driver' => $mailConfig->driver,
            'host' => $mailConfig->host,
            'port' => $mailConfig->port,
            'encryption' => $mailConfig->encryption,
            'username' => $mailConfig->username,
            'password' => $mailConfig->password,
            'from' => [
                'address' => $mailConfig->from_address,
                'name' => $mailConfig->to_address,
            ],
            'sendmail' => '/usr/sbin/sendmail -bs',
        ];
    }
}
