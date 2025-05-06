<?php

namespace App\Models;

use App\Enums\CalculationMethodsEnum;
use Illuminate\Database\Eloquent\Model;

class CalculationHistory extends Model
{
    protected $fillable = [
        'first_operand',
        'second_operand',
        'operation',
        'result'
    ];

    protected function casts(): array
    {
        return [
            'operation' => CalculationMethodsEnum::class,
        ];
    }
}
