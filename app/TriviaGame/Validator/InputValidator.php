<?php

namespace App\TriviaGame\Validator;

use App\Contracts\GameInterface;
use App\Contracts\QuestionInterface;
use App\Contracts\SubmittedAnswerValidatorInterface;

final class InputValidator implements SubmittedAnswerValidatorInterface
{
    public function __construct(private readonly GameInterface $game)
    {
    }

    public function validate(mixed $input): bool
    {
        $question = $this->game->questions();
        $lastQuestion = end($question) ?: null;

        if (!$possibleAnswers = $lastQuestion?->possibleAnswers()) {
            return true;
        }
        /** @var $lastQuestion QuestionInterface */
        return in_array($input, $possibleAnswers);
    }
}
