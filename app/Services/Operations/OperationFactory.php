<?php

namespace App\Services\Operations;

use App\Enums\CalculationMethodsEnum;
use InvalidArgumentException;

class OperationFactory
{
    public function make(CalculationMethodsEnum $operation): OperationInterface
    {
        return match ($operation) {
            CalculationMethodsEnum::ADD => new AddOperation(),
            CalculationMethodsEnum::SUBTRACT => new SubtractOperation(),
            CalculationMethodsEnum::MULTIPLY => new MultiplyOperation(),
            CalculationMethodsEnum::DIVIDE => new DivideOperation(),
        };
    }
}
