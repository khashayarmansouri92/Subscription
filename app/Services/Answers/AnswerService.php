<?php

namespace App\Services\Answers;

use App\Models\Game;
use App\Models\Question;
use App\Traits\InteractsWithAnswer;
use Illuminate\Database\Eloquent\Model;

class AnswerService implements AnswerServiceInterface
{
    use InteractsWithAnswer;

    /**
     * @param array $data
     * @return Model
     * @throws \Exception
     */
    public function store(array $data): Model
    {
        return $this->AnswerRepository()->store($data);
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function setCorrectAnswer(array $data): bool
    {
        $answer = $this->AnswerRepository()->findByKeyValue($data);

        return $this->AnswerRepository()->update($answer, [
            'correct_answer' => 1
        ]);
    }

    /**
     * @param Question $question
     * @param Game $game
     * @param string $correct_answer
     * @return bool
     * @throws \Exception
     */
    public function boolAnswerStore(Question $question, Game $game, string|int $correct_answer): bool
    {
        $this->AnswerService()->store([
            'question_id' => $question->id,
            'game_id' => $game->id,
            'correct_answer' => $correct_answer === "true" ? 1 : 0,
            'content' => 'true'
        ]);


        $this->AnswerService()->store([
            'question_id' => $question->id,
            'game_id' => $game->id,
            'correct_answer' => $correct_answer == 'false' ? 1 : 0,
            'content' => 'false'
        ]);

        return true;
    }
}
