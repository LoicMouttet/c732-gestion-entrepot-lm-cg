<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 1. API INTERNE (Utilisée par le frontend de votre application / requêtes AJAX)
Route::prefix('internal')->group(function () {
    Route::get('/entrepots', [EntrepotController::class, 'apiIndex']);
    Route::get('/entrepots/{id}', [EntrepotController::class, 'apiShow']);
});

// 2. API EXTERNE (Destinée aux services tiers ou clients extérieurs)
Route::prefix('v1')->group(function () {
    Route::get('/entrepots', [EntrepotController::class, 'apiIndex']);
    Route::get('/entrepots/{id}', [EntrepotController::class, 'apiShow']);
});
