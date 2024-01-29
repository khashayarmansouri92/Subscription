<?php

namespace App\Repositories\Questions;

interface QuestionRepositoryInterface
{
    public function getAnswersContent($question): array | null;
    public function getcorrectsContent($question): array | null;
}
