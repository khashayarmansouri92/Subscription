<?php

namespace App\Services\Games;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface GameServiceInterface
{
    public function start(): Model;
    public function getQuestions(Game $game): Collection|null;
}
