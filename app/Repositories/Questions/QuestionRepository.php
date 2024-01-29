<?php

namespace App\Repositories\Questions;

use App\Models\Question;
use App\Repositories\BaseRepository;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    public function __construct(Question $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $question
     * @return array
     */
    public function getAnswersContent($question): array | null
    {
        return $question->answers->pluck('content')->toArray();
    }

    /**
     * @param $question
     * @return array
     */
    public function getcorrectsContent($question): array | null
    {
        return $question->answers->where('correct_answer' , 1)->pluck('content')->toArray();
    }
}
