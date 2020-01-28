<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GuzzleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\GuzzleHttp\Client::class, function ($app) {
            return new \GuzzleHttp\Client(['verify' => false]);
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
