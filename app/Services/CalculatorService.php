<?php

namespace App\Services;

use App\DTO\CalculatorData;
use App\Enums\CalculationMethodsEnum;
use App\Services\Operations\OperationFactory;

class CalculatorService
{
    public function __construct(
        protected OperationFactory $factory
    ) {}

    public function calculate(CalculatorData $data): float
    {
        $operation = $this->factory->make(CalculationMethodsEnum::from($data->operation));
        return $operation->calculate($data->a, $data->b);
    }
}
