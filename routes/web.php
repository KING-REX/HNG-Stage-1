<?php

use App\Http\Controllers\NumberClassificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});