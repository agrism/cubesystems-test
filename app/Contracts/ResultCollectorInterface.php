<?php

namespace App\Contracts;


interface ResultCollectorInterface
{
    public function create(GameInterface $game): MessageInterface;
}
