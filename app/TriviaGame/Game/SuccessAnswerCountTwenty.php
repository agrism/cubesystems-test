<?php

namespace App\TriviaGame\Game;

use App\Contracts\SuccessTargetCountInterface;

final class SuccessAnswerCountTwenty implements SuccessTargetCountInterface
{
    public function __invoke(): int
    {
        return 20;
    }
}
