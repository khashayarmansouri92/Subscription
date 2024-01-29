<?php

namespace App\Repositories\Answers;

use App\Models\Answer;
use App\Repositories\BaseRepository;

class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface
{
    public function __construct(Answer $model)
    {
        parent::__construct($model);
    }
}
