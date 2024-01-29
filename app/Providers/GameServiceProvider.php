<?php

namespace App\Providers;

use App\Repositories\Games\GameRepository;
use App\Repositories\Games\GameRepositoryInterface;
use App\Services\Games\GameService;
use App\Services\Games\GameServiceInterface;
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GameServiceInterface::class, GameService::class);
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
