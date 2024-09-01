<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Resources\ApiResponse\ApiResponseResource;
use App\Http\Resources\ApiResponse\ResourcesTrait;
use App\Traits\InteractsWithExpiredSubscription;
use Exception;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AdminAction
{
    use InteractsWithExpiredSubscription, ResourcesTrait;

    /**
     * @return ApiResponseResource
     * @throws Exception
     */
    public function __invoke(): ApiResponseResource
    {
        return $this->success(
            $this->ExpiredSubscriptionRepository()->firstOrFail(),
            trans('messages.welcome'),
            HttpFoundationResponse::HTTP_OK);
    }
}


