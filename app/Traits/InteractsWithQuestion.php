<?php

namespace App\Traits;

use App\Repositories\Questions\QuestionRepositoryInterface;
use App\Services\Questions\QuestionServiceInterface;

trait InteractsWithQuestion
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function QuestionService()
    {
        try {
            return app()->make(QuestionServiceInterface::class);
        } catch (\Exception $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function QuestionRepository()
    {
        try {
            return app()->make(QuestionRepositoryInterface::class);
        } catch (\Exception $e) {
            throw new \Exception('Error');
        }
    }
}
