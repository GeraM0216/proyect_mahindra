<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function () {
    return view('starting_page');
});

Route::get('chat', [OpenAIController::class,'index']);