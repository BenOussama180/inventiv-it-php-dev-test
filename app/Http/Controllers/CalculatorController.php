<?php

namespace App\Http\Controllers;

use App\DTO\CalculatorData;
use App\Http\Requests\Calculator\CalculatorRequest;
use App\Models\CalculationHistory;
use App\Services\CalculatorService;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator.index', [
            'history' => CalculationHistory::query()
                ->latest()
                ->take(10)
                ->get(),
        ]);
    }

    public function calculate(CalculatorRequest $request, CalculatorService $calculatorService)
    {
        $data = CalculatorData::fromRequest($request);

        $result = $calculatorService->calculate($data);

        // Using the `defer` method to have instant feedback to the user & delay the execution of the callback
        defer(
            function () use ($data, $result) {
                CalculationHistory::create([
                    'first_operand' => $data->a,
                    'second_operand' => $data->b,
                    'operation' => $data->operation,
                    'result' => $result,
                ]);
            }
        );

        return to_route('calculator.index')->with(['result' => $result]);
    }
}
