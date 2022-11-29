<?php

namespace App\Contracts;

use App\TriviaGame\Response\Message;
use App\TriviaGame\Response\ResponseValue;

interface ResponseFactoryInterface
{
    public function __construct(GameInterface $game, Message $message);

    public function create(): ResponseValue;
}
