<?php

namespace App\TriviaGame\Game;

use App\Contracts\GameInterface;
use App\Contracts\QuestionFactoryInterface;
use App\Contracts\QuestionInterface;
use App\Contracts\SuccessTargetCountInterface;

final class Game implements GameInterface
{
    public function __construct(
        private readonly QuestionFactoryInterface $questionFactory,
        private readonly SuccessTargetCountInterface $successTargetCount
    ) {
    }

    /** @var QuestionInterface[] */
    private array $questions = [];
    private bool $isGameOver = false;
    private int $countOfSuccessAnswers = 0;

    public function process(?string $submittedAnswer): self
    {
        if (!$this->prepareGame()->handleSubmittedAnswer($submittedAnswer)->isGameOver()) {
            $whileExitCounterLimit = 10;
            $whileExitCounter = 0;
            while (true) {
                $newQuestion = $this->questionFactory->create();
                if (!$this->doesGameHaveQuestion($newQuestion)) {
                    $this->questions[] = $this->questionFactory->create();
                    break;
                }
                if($whileExitCounter++ >= $whileExitCounterLimit){
                    break;
                }
            }
        }

        return $this;
    }

    /**
     * @return QuestionInterface[]
     */
    public function questions(): array
    {
        return $this->questions;
    }

    public function isGameOver(): bool
    {
        return $this->isGameOver;
    }

    public function isGameWon(): bool
    {
        return $this->isGameOver()
            && ($this->successTargetCount)() === $this->countOfSuccessAnswers();
    }

    public function countOfSuccessAnswers(): int
    {
        return $this->countOfSuccessAnswers;
    }

    private function lastQuestion(): ?QuestionInterface
    {
        $questions = $this->questions();
        $lastQuestion = end($questions);

        return $lastQuestion ?: null;
    }

    private function isSuccessTargetReached(): bool
    {
        return $this->countOfSuccessAnswers() >= ($this->successTargetCount)();
    }

    private function closeGame(): self
    {
        $this->isGameOver = true;
        return $this;
    }

    private function handleSubmittedAnswer(?string $submittedAnswer): self
    {
        if (empty($submittedAnswer)) {
            return $this;
        }

        if (!$lastQuestion = $this->lastQuestion()) {
            return $this;
        }

        if ($lastQuestion->submittedAnswer() !== null) {
            return $this;
        }

        $lastQuestion->registerSubmittedAnswer($submittedAnswer);

        if ($lastQuestion->submittedAnswer() === $lastQuestion->correctAnswer()) {
            $this->countOfSuccessAnswers++;

            if (!$this->isSuccessTargetReached()) {
                return $this;
            }
        }

        return $this->closeGame();
    }

    private function prepareGame(): self
    {
        if ($this->isGameOver()) {
            $this->isGameOver = false;
        }
        return $this;
    }

    private function doesGameHaveQuestion(QuestionInterface $question): bool
    {
        return collect($this->questions())->filter(function (QuestionInterface $existingQuestion) use ($question) {
            return $existingQuestion->question() === $question->question();
        })->isNotEmpty();
    }
}
