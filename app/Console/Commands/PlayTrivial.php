<?php

namespace App\Console\Commands;

use App\Models\Question;
use App\Services\Answers\AnswerServiceInterface;
use App\Services\Games\GameServiceInterface;
use App\Services\Questions\QuestionServiceInterface;
use App\Services\Users\UserServiceInterface;
use Illuminate\Console\Command;

class PlayTrivial extends Command
{
    protected $signature = 'a';
//    protected $signature = 'trivial:play';

    protected $description = 'Start a Trivial game';

    private $gameService;
    private $userService;
    private $questionService;
    private $answerService;

    private $game;
    private $mainUser;
    private $member;

    private $type = 'start';
    private $correct = 0;

    public function __construct(
        GameServiceInterface     $gameService,
        UserServiceInterface     $userService,
        QuestionServiceInterface $questionService,
        AnswerServiceInterface   $answerService
    )
    {
        parent::__construct();

        $this->gameService = $gameService;
        $this->userService = $userService;
        $this->questionService = $questionService;
        $this->answerService = $answerService;
    }

    public function handle()
    {
        $this->welcomePlayer();

        $this->startGame();

        $this->addQuestions();

        $this->confirmToStart();

        $this->playGame();

        $this->endGame();
    }

    private function welcomePlayer()
    {
        $this->info(trans('messages.welcome'));
    }

    private function startGame()
    {
        $this->game = $this->gameService->start();

        $player1Name = $this->askForPlayerName('player1');
        $this->mainUser = $this->userService->firstOrCreate($player1Name, true);
        $this->userService->attach($this->mainUser, $this->game);

        $player2Name = $this->askForPlayerName('player2');
        $this->member = $this->userService->firstOrCreate($player2Name, false);
        $this->userService->attach($this->member, $this->game);
    }

    private function askForPlayerName(string $name)
    {
        return $this->ask(trans('messages.enter_player', ['name' => $name]));
    }

    private function addQuestions()
    {
        do {
            if ($this->type === 'exit') {
                return;
            }

            if ($this->type === 'save') {
                break;
            }

            $this->info(trans('messages.add_questions', ['player' => $this->mainUser->name]));

            $questionContent = $this->askForQuestion();

            if ($this->type === 'start') {
                $this->type = $this->askForTypeQuestion();
            }

            $question = $this->createQuestion($questionContent);

            if ($this->type === 'bool') {
                $this->createBoolAnswer($question);
            } else {
                $this->createMultipleAnswers($question);
            }

            $this->askForNextType();

        } while (true);
    }

    private function askForQuestion()
    {
        return $this->ask(trans('messages.question_content'));
    }

    private function createQuestion(string|int $content)
    {
        return $this->questionService->store([
            'content' => $content,
            'type' => $this->type,
            'game_id' => $this->game->id
        ]);
    }

    private function createBoolAnswer(Question $question)
    {
        $correctAnswer = $this->askForBoolAnswer();

        $this->answerService->boolAnswerStore($question, $this->game, $correctAnswer);
    }

    private function askForBoolAnswer()
    {
        return $this->choice(trans('messages.select_correct'), ['true', 'false']);
    }

    private function askForTypeQuestion()
    {
        return $this->type = $this->choice(trans('messages.select_more_type'), ['multi_choice', 'bool'], null, null, false);
    }

    private function createMultipleAnswers(Question $question)
    {
        $options = $this->askForOptions();

        foreach ($options as $option) {
            $this->answerService->store([
                'question_id' => $question->id,
                'game_id' => $this->game->id,
                'correct_answer' => 0,
                'content' => $option
            ]);
        }

        $correctAnswer = $this->askForCorrectAnswer($options);

        $this->answerService->setCorrectAnswer([
            'question_id' => $question->id,
            'game_id' => $this->game->id,
            'content' => $correctAnswer
        ]);
    }

    private function askForOptions()
    {
        $options = [];

        do {
            $option = $this->ask(trans('messages.enter_option'));
            if (!empty($option)) {
                $options[] = $option;
            }
        } while (!empty($option));

        return $options;
    }

    private function askForCorrectAnswer(array $options)
    {
        return $this->choice(trans('messages.select_correct'), $options);
    }

    private function askForNextType()
    {
        $this->type = $this->choice(trans('select_next-action'), ['exit', 'save', 'multi_choice', 'bool']);
    }

    private function confirmToStart()
    {
        $confirmation = $this->ask(trans('messages.start_game', ['name' => $this->member->username]));

        if ($confirmation != null) {
            $this->info(trans('messages.game_over'));
            exit;
        }
    }

    private function playGame()
    {
        $questions = $this->gameService->getQuestions($this->game);

        foreach ($questions as $question) {
            $answers = $this->questionService->getAnswersContent($question);

            $correctAnswer = $this->questionService->getCorrectsContent($question);

            $selectedAnswer = $this->askQuestion($question, $answers);

            if ($selectedAnswer === $correctAnswer) {
                $this->correct++;
            }
        }
    }

    private function askQuestion(Question $question, array $answers)
    {
        return $this->choice($question->content, $answers);
    }

    private function endGame()
    {
        $total = $this->gameService->getTotalQuestions($this->game);

        $this->info(trans('messages.total_questions') . ": $total");
        $this->info(trans('messages.correct') . ": " . $this->correct);
        $this->info(trans('messages.wrong') . ": " . ($total - $this->correct));

        $this->info(trans('messages.game_ended'));
    }
}
