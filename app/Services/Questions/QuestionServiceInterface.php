<?php

namespace App\Services\Questions;

use App\Models\Question;

interface QuestionServiceInterface
{
    public function getAnswersContent(Question $question): array | null;
    public function getCorrectsContent(Question $question): array | null;
}
