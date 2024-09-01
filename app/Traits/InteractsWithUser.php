<?php

namespace App\Traits;

use App\Repositories\Users\UserRepositoryInterface;
use App\Services\Users\UserServiceInterface;
use Exception;

trait InteractsWithUser
{
    /**
     * @return mixed
     * @throws Exception
     */
    public function UserService(): mixed
    {
        try {
            return app()->make(UserServiceInterface::class);
        } catch (Exception $e) {
            throw new Exception('Error');
        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function UserRepository(): mixed
    {
        try {
            return app()->make(UserRepositoryInterface::class);
        } catch (Exception $e) {
            throw new Exception('Error');
        }
    }
}
