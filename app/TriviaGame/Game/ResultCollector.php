<?php

namespace App\TriviaGame\Game;


use App\Contracts\GameInterface;
use App\Contracts\MessageInterface;
use App\Contracts\QuestionInterface;
use App\Contracts\ResultCollectorInterface;
use App\Enums\MessageType;

final class ResultCollector implements ResultCollectorInterface
{
    public function create(GameInterface $game): MessageInterface
    {
        $questions = $game->questions();

        /** @var QuestionInterface $gameLastQuestion */
        $gameLastQuestion = end($questions);
        $messageType = MessageType::NO;
        $messages = [];

        if ($game->isGameOver()) {
            if ($game->isGameWon()) {
                $messageType = MessageType::SUCCESS;
                $messages[] = 'Great success!';
            } else {
                $messages[] = 'Game over, you lost!';
                $messages[] = sprintf('Last question: %s', $gameLastQuestion->question());
                $messages[] = sprintf('Correct answer to last question: %s', $gameLastQuestion->correctAnswer());
                $messages[] = sprintf('Your answer: %s', $gameLastQuestion->submittedAnswer());
                $messageType = MessageType::ALERT;
            }

            $messages[] = 'Correct answers in row: ' . $game->countOfSuccessAnswers();
        }

        return app(MessageInterface::class, [
            'text' => implode('</br>', $messages),
            'type' => $messageType
        ]);
    }

}
