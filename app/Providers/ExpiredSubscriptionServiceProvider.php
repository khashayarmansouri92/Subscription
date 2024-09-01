<?php

namespace App\Providers;

use App\Repositories\ExpiredSubscription\ExpiredSubscriptionRepository;
use App\Repositories\ExpiredSubscription\ExpiredSubscriptionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ExpiredSubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ExpiredSubscriptionRepositoryInterface::class, ExpiredSubscriptionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
