<?php

namespace App\TriviaGame\Generators;

use App\Contracts\QuestionGeneratorInterface;

final class NumbersApiQuestionGenerator implements QuestionGeneratorInterface
{
    private const URL = 'http://numbersapi.com/random?json&fragment&min=1&max=200';
    private ?string $question = null;
    private ?int $answer = null;

    public function generate(): self
    {
        $ch = curl_init(self::URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        $this->question = data_get($result, 'text');
        $answer = data_get($result, 'number');

        if ($answer !== null) {
            $this->answer = intval($answer);
        }

        return $this;
    }

    public function question(): ?string
    {
        return $this->question;
    }

    public function answer(): ?int
    {
        return $this->answer;
    }
}
