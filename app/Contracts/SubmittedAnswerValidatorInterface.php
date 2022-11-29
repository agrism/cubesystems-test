<?php

namespace App\Contracts;

interface SubmittedAnswerValidatorInterface
{
    public function __construct(GameInterface $game);

    public function validate(mixed $input): bool;
}
