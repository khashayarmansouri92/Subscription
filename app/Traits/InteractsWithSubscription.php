<?php

namespace App\Traits;

use App\Repositories\Subscription\SubscriptionRepositoryInterface;
use App\Services\Subscription\SubscriptionServiceInterface;
use Exception;

trait InteractsWithSubscription
{
    /**
     * @return mixed
     * @throws Exception
     */
    public function SubscriptionService(): mixed
    {
        try {
            return app()->make(SubscriptionServiceInterface::class);
        } catch (Exception $e) {
            throw new Exception('Error');
        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function SubscriptionRepository(): mixed
    {
        try {
            return app()->make(SubscriptionRepositoryInterface::class);
        } catch (Exception $e) {
            throw new Exception('Error');
        }
    }
}
