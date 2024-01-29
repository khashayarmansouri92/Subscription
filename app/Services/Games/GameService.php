<?php

namespace App\Services\Games;

use App\Models\Game;
use App\Traits\InteractsWithGame;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class GameService implements GameServiceInterface
{
    use InteractsWithGame;

    /**
     * @return Model
     * @throws \Exception
     */
    public function start(): Model
    {
        $token = $this->generateName();
        return $this->GameRepository()->store([
            'title' => $token
        ]);
    }

    /**
     * @return string
     */
    private function generateName(): string
    {
        return 'Trivial-' . Str::random(5);
    }

    /**
     * @param Game $game
     * @return Collection|null
     * @throws \Exception
     */
    public function getQuestions(Game $game): Collection|null
    {
        return $this->GameRepository()->questions($game);
    }

    /**
     * @param Game $game
     * @return int|null
     * @throws \Exception
     */
    public function getTotalQuestions(Game $game): int|null
    {
        return $this->GameRepository()->total($game);
    }
}
