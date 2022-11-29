<?php

namespace App\TriviaGame\Storage;

use App\Contracts\GameInterface;
use App\Contracts\StorageInterface;
use Illuminate\Support\Facades\Session;

final class SessionStorage implements StorageInterface
{
    private string $key = 'game';

    public function load(): ?GameInterface
    {
        return Session::get($this->key);
    }

    public function store(GameInterface $game): self
    {
        Session::put($this->key, $game);
        Session::save();
        return $this;
    }

    public function delete(): self
    {
        Session::remove($this->key);
        Session::save();
        return $this;
    }
}
