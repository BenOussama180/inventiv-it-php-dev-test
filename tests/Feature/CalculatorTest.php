<?php

use App\Models\CalculationHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('calculates addition correctly', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        'b' => 5,
        'operation' => 'add',
    ]);

    $response->assertRedirect(route('calculator.index'));
    $response->assertSessionHas('result', 15);

    expect(CalculationHistory::count())->toBe(1);
    expect(CalculationHistory::first()->result)->toEqual(15);
});

it('calculates subtraction correctly', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        'b' => 5,
        'operation' => 'subtract',
    ]);

    $response->assertRedirect(route('calculator.index'));
    $response->assertSessionHas('result', 5);

    expect(CalculationHistory::count())->toBe(1);
    expect(CalculationHistory::first()->result)->toEqual(5);
});

it('calculates multiplication correctly', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        'b' => 5,
        'operation' => 'multiply',
    ]);

    $response->assertRedirect(route('calculator.index'));
    $response->assertSessionHas('result', 50);

    expect(CalculationHistory::count())->toBe(1);
    expect(CalculationHistory::first()->result)->toEqual(50);
});

it('calculates division correctly', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        'b' => 5,
        'operation' => 'divide',
    ]);

    $response->assertRedirect(route('calculator.index'));
    $response->assertSessionHas('result', 2);

    expect(CalculationHistory::count())->toBe(1);
    expect(CalculationHistory::first()->result)->toEqual(2);
});

it('prevents division by zero', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        'b' => 0,
        'operation' => 'divide',
    ]);

    $response->assertSessionHasErrors(['b']);
    expect(CalculationHistory::count())->toEqual(0);
});

it('requires first number', function () {
    $response = $this->post(route('calculator.calculate'), [
        // 'a' => 10, // Missing
        'b' => 5,
        'operation' => 'add',
    ]);

    $response->assertSessionHasErrors(['a']);
    expect(CalculationHistory::count())->toEqual(0);
});

it('requires second number', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        // 'b' => 5, // Missing
        'operation' => 'add',
    ]);

    $response->assertSessionHasErrors(['b']);
    expect(CalculationHistory::count())->toEqual(0);
});

it('requires operation', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        'b' => 5,
        // 'operation' => 'add', // Missing
    ]);

    $response->assertSessionHasErrors(['operation']);
    expect(CalculationHistory::count())->toEqual(0);
});

it('handles invalid operation', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        'b' => 5,
        'operation' => 'invalid_operation',
    ]);

    $response->assertSessionHasErrors(['operation']);
    expect(CalculationHistory::count())->toEqual(0);
});

it('validates first number is numeric', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 'not-a-number',
        'b' => 5,
        'operation' => 'add',
    ]);

    $response->assertSessionHasErrors(['a']);
    expect(CalculationHistory::count())->toEqual(0);
});

it('validates second number is numeric', function () {
    $response = $this->post(route('calculator.calculate'), [
        'a' => 10,
        'b' => 'not-a-number',
        'operation' => 'add',
    ]);

    $response->assertSessionHasErrors(['b']);
    expect(CalculationHistory::count())->toEqual(0);
});

it('displays the calculator form', function () {
    $response = $this->get(route('calculator.index'));
    $response->assertStatus(200);
    $response->assertViewIs('calculator.index');
    $response->assertSee('Calculator');
});
