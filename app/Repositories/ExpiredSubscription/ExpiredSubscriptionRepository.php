<?php

namespace App\Repositories\ExpiredSubscription;

use App\Models\ExpiredSubscription;
use App\Repositories\BaseRepository;

class ExpiredSubscriptionRepository extends BaseRepository implements ExpiredSubscriptionRepositoryInterface
{
    public function __construct(ExpiredSubscription $model)
    {
        parent::__construct($model);
    }

    /**
     * @return int
     */
    public function ExpiredSubscriptionCount(): int
    {
        return ExpiredSubscription::query()->increment('count');
    }
}
