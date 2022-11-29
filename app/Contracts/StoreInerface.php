<?php

namespace App\Contracts;

interface StoreInerface
{
    public function put(string $key, GameInterface $game): self;
    public function get(string $key): ?GameInterface;
    public function remove(string $key): self;
}
