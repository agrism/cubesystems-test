<?php

namespace App\Contracts;

interface QuestionFactoryInterface
{

    public function __construct(QuestionGeneratorInterface $generator);

    public function create(): QuestionInterface;
}
