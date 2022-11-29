<?php

namespace App\TriviaGame\Factories;

use App\Contracts\GameInterface;
use App\Contracts\MessageInterface;
use App\Contracts\ResponseFactoryInterface;
use App\TriviaGame\Response\ResponseValue;


final class ResponseFactory implements ResponseFactoryInterface
{
    public function __construct(readonly private GameInterface $game, readonly private MessageInterface $message)
    {
    }

    public function create(): ResponseValue
    {
        $gameQuestion = $this->game->questions();
        $gameLastQuestion = end($gameQuestion);

        return app(ResponseValue::class, [
                'question' => $gameLastQuestion?->question(),
                'answers' => (array)$gameLastQuestion?->possibleAnswers(),
                'isGameOver' => $this->game->isGameOver(),
                'messageText' => $this->message->text(),
                'messageType' => $this->message->type()
            ]
        );
    }
}
