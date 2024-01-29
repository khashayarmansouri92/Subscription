<?php

namespace App\Traits;

use App\Repositories\Answers\AnswerRepositoryInterface;
use App\Services\Answers\AnswerServiceInterface;

trait InteractsWithAnswer
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function AnswerService()
    {
        try {
            return app()->make(AnswerServiceInterface::class);
        } catch (\Exception $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function AnswerRepository()
    {
        try {
            return app()->make(AnswerRepositoryInterface::class);
        } catch (\Exception $e) {
            throw new \Exception('Error');
        }
    }
}
