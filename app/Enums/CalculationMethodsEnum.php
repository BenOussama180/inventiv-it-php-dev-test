<?php

namespace App\Enums;

use App\Traits\EnumsTrait;

enum CalculationMethodsEnum: string
{
    use EnumsTrait;

    case ADD = 'add';
    case SUBTRACT = 'subtract';
    case MULTIPLY = 'multiply';
    case DIVIDE = 'divide';

    public static function getLabel(string $value): string
    {
        return match ($value) {
            self::ADD->value => 'Addition',
            self::SUBTRACT->value => 'Subtraction',
            self::MULTIPLY->value => 'Multiplication',
            self::DIVIDE->value => 'Division',
        };
    }

    public function sign(): string
    {
        return match ($this->value) {
            self::ADD->value => '+',
            self::SUBTRACT->value => '-',
            self::MULTIPLY->value => '*',
            self::DIVIDE->value => '/',
        };
    }
}
