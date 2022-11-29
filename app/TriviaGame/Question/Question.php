<?php

namespace App\TriviaGame\Question;

use App\Contracts\QuestionInterface;

final class Question implements QuestionInterface
{
    /*** @var string[] */
    private array $possibleAnswers = [];

    private ?string $submittedAnswer = null;

    public function __construct(private readonly string $question, private readonly string $correctAnswer)
    {
        $this->addPossibleAnswer($this->correctAnswer)
            ->addRandomAdditionalAnswers(2)
            ->shufflePossibleAnswers();
    }

    public function question(): string
    {
        return $this->question;
    }

    /**
     * @return string[]
     */
    public function possibleAnswers(): array
    {
        return $this->possibleAnswers;
    }

    public function submittedAnswer(): ?string
    {
        return $this->submittedAnswer;
    }

    public function correctAnswer(): string
    {
        return $this->correctAnswer;
    }

    public function registerSubmittedAnswer(string $answer): self
    {
        $this->submittedAnswer = $answer;

        return $this;
    }

    private function addPossibleAnswer(string $answer): self
    {
        $this->possibleAnswers[] = $answer;

        return $this;
    }

    public function addRandomAdditionalAnswers(int $count = 1): self
    {
        $count = $count > 0 ? $count : 1;

        for ($i = 0; $i < $count; $i++) {
            $this->addPossibleAnswer(strval(rand(min: -1, max: -200)));
        }
        return $this;
    }

    private function shufflePossibleAnswers(): self
    {
        shuffle($this->possibleAnswers);

        return $this;
    }

}
