<?php

namespace App\Services\Answers;

use App\Models\Game;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

interface AnswerServiceInterface
{
    public function store(array $data): Model;

    public function setCorrectAnswer(array $data): bool;

    public function boolAnswerStore(Question $question, Game $game, string|int $correct_answer): bool;
}
