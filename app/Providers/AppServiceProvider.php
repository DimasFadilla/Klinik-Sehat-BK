<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth; 
use App\Models\Dokter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        // Auth::extend('dokter', function ($app) {
        //     return new \Illuminate\Auth\EloquentUserProvider(
        //         $app['hash'],
        //         Dokter::class
        //     );
        // });
    }
}
