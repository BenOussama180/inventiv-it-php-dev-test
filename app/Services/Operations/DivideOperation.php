<?php

namespace App\Services\Operations;

use InvalidArgumentException;

class DivideOperation implements OperationInterface
{
    public function calculate(float $a, float $b): float
    {
        if ($b === 0.0) {
            throw new InvalidArgumentException('Division by zero.');
        }

        return $a / $b;
    }
}
