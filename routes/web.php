<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepotController;

Route::get('/', [EntrepotController::class, 'index'])->name('home');
