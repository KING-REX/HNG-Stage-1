<?php

use App\Http\Controllers\NumberClassificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/classify-number', [NumberClassificationController::class, 'retrieve']);
