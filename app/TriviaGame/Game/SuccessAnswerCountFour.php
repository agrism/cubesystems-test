<?php

namespace App\TriviaGame\Game;

use App\Contracts\SuccessTargetCountInterface;

final class SuccessAnswerCountFour implements SuccessTargetCountInterface
{
    public function __invoke(): int
    {
        return 4;
    }

}
