<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
//use ConsoleTVs\Charts\Registrar as Charts;

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
    /* public function boot(Charts $charts, UrlGenerator $url)
    {
        if(env('APP_ENV') === 'production')
        {
            $url->forceScheme('https');
        }

        $charts->register([
            \App\Charts\ResultChart::class
        ]);
    }*/
}
