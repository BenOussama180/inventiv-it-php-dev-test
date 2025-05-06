<?php

namespace App\Services\Operations;

class MultiplyOperation implements OperationInterface
{
    public function calculate(float $a, float $b): float
    {
        return $a * $b;
    }
}
