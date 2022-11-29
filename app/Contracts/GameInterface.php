<?php

namespace App\Contracts;

interface GameInterface
{
    public function __construct(QuestionFactoryInterface $factory, SuccessTargetCountInterface $successTargetCount);

    public function process(?string $submittedAnswer): self;

    public function questions(): array;

    public function isGameOver(): bool;

    public function isGameWon(): bool;

    public function countOfSuccessAnswers(): int;
}
