<?php

namespace App\Services\Operations;

interface OperationInterface
{
    public function calculate(float $a, float $b): float;
}
