<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/calculator');

require __DIR__ . '/calculator.php';
