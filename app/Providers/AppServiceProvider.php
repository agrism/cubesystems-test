<?php

namespace App\Providers;

use App\Contracts\GameInterface;
use App\Contracts\MessageInterface;
use App\Contracts\QuestionFactoryInterface;
use App\Contracts\QuestionGeneratorInterface;
use App\Contracts\QuestionInterface;
use App\Contracts\ResponseFactoryInterface;
use App\Contracts\ResultCollectorInterface;
use App\Contracts\StorageInterface;
use App\Contracts\SubmittedAnswerValidatorInterface;
use App\Contracts\SuccessTargetCountInterface;
use App\TriviaGame\Factories\QuestionFactory;
use App\TriviaGame\Factories\ResponseFactory;
use App\TriviaGame\Game\Game;
use App\TriviaGame\Game\ResultCollector;
use App\TriviaGame\Game\SuccessAnswerCountTwenty;
use App\TriviaGame\Generators\NumbersApiQuestionGenerator;
use App\TriviaGame\Question\Question;
use App\TriviaGame\Response\Message;
use App\TriviaGame\Storage\SessionStorage;
use App\TriviaGame\Validator\InputValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(StorageInterface::class, SessionStorage::class);
        $this->app->bind(GameInterface::class, Game::class);
        $this->app->bind(QuestionInterface::class, Question::class);
        $this->app->bind(QuestionFactoryInterface::class, QuestionFactory::class);
        $this->app->bind(QuestionGeneratorInterface::class, NumbersApiQuestionGenerator::class);
        $this->app->bind(ResultCollectorInterface::class, ResultCollector::class);
        $this->app->bind(ResponseFactoryInterface::class, ResponseFactory::class);
        $this->app->bind(MessageInterface::class, Message::class);
        $this->app->bind(SubmittedAnswerValidatorInterface::class, InputValidator::class);
        $this->app->bind(SuccessTargetCountInterface::class, SuccessAnswerCountTwenty::class);
    }
}
