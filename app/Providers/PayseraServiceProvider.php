<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PayseraService;

class PayseraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PayseraService::class, function ($app) {
            $paysera = new PayseraService(
                [
                    'projectid'     => 181640,
                    'sign_password' => '7a454e7433a5d90aa84b5cf9988aabd4',
                ]
            );
            return $paysera;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
