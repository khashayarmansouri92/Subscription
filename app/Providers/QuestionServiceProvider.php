<?php

namespace App\Providers;

use App\Repositories\Questions\QuestionRepository;
use App\Repositories\Questions\QuestionRepositoryInterface;
use App\Services\Questions\QuestionService;
use App\Services\Questions\QuestionServiceInterface;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QuestionServiceInterface::class, QuestionService::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
