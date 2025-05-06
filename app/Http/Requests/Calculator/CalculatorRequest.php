<?php

namespace App\Http\Requests\Calculator;

use App\Enums\CalculationMethodsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalculatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'a' => ['required', Rule::numeric()],
            'b' => [
                'required',
                Rule::numeric(),
                function ($attribute, $value, $fail) {
                    if ($this->safe()->input('operation') === CalculationMethodsEnum::DIVIDE->value && (float)$value === 0.0) {
                        $fail('The ' . $attribute . ' cannot be zero when dividing.');
                    }
                }
            ],
            'operation' => ['required', Rule::in(CalculationMethodsEnum::values())],
        ];
    }
}
