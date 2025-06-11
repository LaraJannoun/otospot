<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cache;
use Config;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config = array(
            'driver'     => Cache::get('MAIL_DRIVER'),
            'host'       => Cache::get('MAIL_HOST'),
            'port'       => Cache::get('MAIL_PORT'),
            'username'   => Cache::get('ACCESS_KEY'),
            'password'   => Cache::get('SECRET_KEY'),
            'from'       => Cache::get('MAIL_FROM'),
            'encryption' => Cache::get('MAIL_ENC')
        );
        Config::set('mail', $config);
    }
}
