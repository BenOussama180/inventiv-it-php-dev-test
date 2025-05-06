<?php

use App\Http\Controllers\CalculatorController;
use Illuminate\Support\Facades\Route;

Route::as('calculator.')
    ->prefix('calculator')
    ->controller(CalculatorController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'calculate')->name('calculate');
    });
