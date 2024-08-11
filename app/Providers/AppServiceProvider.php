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
            return new iRacing(config('app.iracing.username'), config('app.iracing.password'));
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
