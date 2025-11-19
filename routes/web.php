<?php

use Illuminate\Support\Facades\Route;
use Spatie\ErrorSolutions\Solutions\Laravel\GenerateAppKeySolution;

Route::get('/', function () {
    return view('welcome');
});


