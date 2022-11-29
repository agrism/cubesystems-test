<?php

namespace App\Contracts;

interface SuccessTargetCountInterface
{
    public function __invoke(): int;
}
