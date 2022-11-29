<?php

namespace App\TriviaGame\Response;

use App\Enums\MessageType;

final class ResponseValue
{
    /**
     * @param string|null $question
     * @param array $answers
     * @param bool|null $isGameOver
     * @param string|null $messageText
     * @param MessageType $messageType
     */
    public function __construct(
        private readonly ?string $question,
        private readonly array $answers = [],
        private readonly ?bool $isGameOver,
        private readonly ?string $messageText,
        private readonly MessageType $messageType = MessageType::NO,
    ) {
    }

    public function __toString(): string
    {
        return json_encode([
            'question' => $this->question,
            'answers' => $this->answers,
            'isGameOver' => $this->isGameOver,
            'message' => [
                'text' => $this->messageText,
                'type' => $this->messageType,
            ],
        ]);
    }
}
