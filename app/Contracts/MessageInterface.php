<?php

namespace App\Contracts;

use App\Enums\MessageType;

interface MessageInterface
{
    public function __construct(string $text, MessageType $type);

    public function text(): string;

    public function type(): MessageType;
}
