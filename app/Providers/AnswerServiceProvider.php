<?php

namespace App\Providers;

use App\Repositories\Answers\AnswerRepository;
use App\Repositories\Answers\AnswerRepositoryInterface;
use App\Services\Answers\AnswerService;
use App\Services\Answers\AnswerServiceInterface;
use Illuminate\Support\ServiceProvider;

class AnswerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AnswerServiceInterface::class, AnswerService::class);
        $this->app->bind(AnswerRepositoryInterface::class, AnswerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
