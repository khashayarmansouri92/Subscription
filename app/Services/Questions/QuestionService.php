<?php

namespace App\Services\Questions;

use App\Models\Question;
use App\Traits\InteractsWithQuestion;
use Illuminate\Database\Eloquent\Model;

class QuestionService implements QuestionServiceInterface
{
    use InteractsWithQuestion;

    /**
     * @param array $data
     * @return Model
     * @throws \Exception
     */
    public function store(array $data): Model
    {
        return $this->QuestionRepository()->store($data);
    }

    /**
     * @param Question $question
     * @return array|null
     * @throws \Exception
     */
    public function getAnswersContent(Question $question): array | null
    {
        return $this->QuestionRepository()->getAnswersContent($question);
    }

    /**
     * @param Question $question
     * @return array|null
     * @throws \Exception
     */
    public function getCorrectsContent(Question $question): array | null
    {
        return $this->QuestionRepository()->getcorrectsContent($question);
    }
}
