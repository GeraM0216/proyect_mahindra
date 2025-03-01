<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;

Route::get('/search', function () {
    return view('search');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('chat', [OpenAIController::class,'index']);