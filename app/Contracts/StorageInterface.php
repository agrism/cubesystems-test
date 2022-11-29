<?php

namespace App\Contracts;

interface StorageInterface
{
    public function load(): ?GameInterface;

    public function store(GameInterface $game): self;

    public function delete(): self;
}
