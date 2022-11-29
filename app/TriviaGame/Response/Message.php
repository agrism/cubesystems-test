<?php

namespace App\TriviaGame\Response;

use App\Contracts\MessageInterface;
use App\Enums\MessageType;

final class Message implements MessageInterface
{
    public function __construct(readonly public string $text, readonly public MessageType $type)
    {
    }

    public function text(): string
    {
        return $this->text;
    }

    public function type(): MessageType
    {
        return $this->type;
    }


}
