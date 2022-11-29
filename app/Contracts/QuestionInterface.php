<?php

namespace App\Contracts;

interface QuestionInterface
{
    public function question(): string;
    public function correctAnswer(): string;
    public function possibleAnswers(): array;
    public function submittedAnswer(): ?string;
    public function registerSubmittedAnswer(string $answer): self;
}
