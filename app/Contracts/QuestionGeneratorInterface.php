<?php

namespace App\Contracts;

interface QuestionGeneratorInterface
{
    public function generate(): self;

    public function question(): ?string;

    public function answer(): ?int;
}
