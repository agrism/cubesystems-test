<?php

namespace App\TriviaGame\Factories;

use App\Contracts\QuestionFactoryInterface;
use App\Contracts\QuestionGeneratorInterface;
use App\Contracts\QuestionInterface;

final class QuestionFactory implements QuestionFactoryInterface
{
    public function __construct(private readonly QuestionGeneratorInterface $generator)
    {
    }

    public function create(): QuestionInterface
    {
        $this->generator->generate();

        return app(QuestionInterface::class, [
            'question' => $this->generator->question(),
            'correctAnswer' => $this->generator->answer(),
        ]);
    }
}
