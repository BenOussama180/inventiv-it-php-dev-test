<?php

namespace App\DTO;

use App\Http\Requests\Calculator\CalculatorRequest;

class CalculatorData
{
    public function __construct(
        public float $a,
        public float $b,
        public string $operation
    ) {}

    public static function fromRequest(CalculatorRequest $request): self
    {
        return new self(
            (float) $request->safe()->input('a'),
            (float) $request->safe()->input('b'),
            $request->safe()->input('operation')
        );
    }
}
