<?php

namespace App\Providers;

use App\Services\BillboardService;
use App\Services\BookingService;
use App\Services\Interfaces\BillboardServiceInterface;
use App\Services\Interfaces\BookingServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookingServiceInterface::class, BookingService::class);
        $this->app->bind(BillboardServiceInterface::class, BillboardService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
