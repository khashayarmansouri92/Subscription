<?php

namespace App\Traits;

use App\Repositories\ExpiredSubscription\ExpiredSubscriptionRepositoryInterface;
use Exception;

trait InteractsWithExpiredSubscription
{
    /**
     * @return mixed
     * @throws Exception
     */
    public function ExpiredSubscriptionRepository(): mixed
    {
        try {
            return app()->make(ExpiredSubscriptionRepositoryInterface::class);
        } catch (Exception $e) {
            throw new Exception('Error');
        }
    }
}
