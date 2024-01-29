<?php

namespace App\Traits;

use App\Repositories\Games\GameRepositoryInterface;
use App\Services\Games\GameServiceInterface;

trait InteractsWithGame
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function GameService()
    {
        try {
            return app()->make(GameServiceInterface::class);
        } catch (\Exception $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function GameRepository()
    {
        try {
            return app()->make(GameRepositoryInterface::class);
        } catch (\Exception $e) {
            throw new \Exception('Error');
        }
    }
}
