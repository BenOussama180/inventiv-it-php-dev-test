<?php

namespace App\Traits;

trait EnumsTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toSelectArray(): array
    {
        return array_map(fn($value) => ['value' => $value, 'label' => self::getLabel($value)], self::values());
    }
}
