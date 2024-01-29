<?php

namespace App\Repositories\Games;

use App\Models\Game;
use Illuminate\Support\Collection;

interface GameRepositoryInterface
{
    public function questions(Game $game): Collection|null;
}
