<?php

namespace App\Repositories\Games;

use App\Models\Game;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class GameRepository extends BaseRepository implements GameRepositoryInterface
{
    public function __construct(Game $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Game $game
     * @return Collection|null
     */
    public function questions(Game $game): Collection|null
    {
        return $game->questions;
    }

    /**
     * @param Game $game
     * @return int|null
     */
    public function total(Game $game): int|null
    {
        return $game->questions()->count();
    }
}
