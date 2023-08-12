<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use iRacingPHP\iRacing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(iRacing::class, function() {
            return new iRacing(env('IRACING_USERNAME'), env('IRACING_PASSWORD'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
