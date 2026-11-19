<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepotController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route publique pour se connecter et récupérer un token Sanctum
Route::post('/login', [AuthController::class, 'login']);

// API INTERNE (Utilisée par le frontend de votre application / requêtes AJAX)
Route::prefix('internal')->group(function () {

    // Routes publiques (Lecture)
    Route::get('/entrepots', [EntrepotController::class, 'apiIndex']);
    Route::get('/entrepots/{id}', [EntrepotController::class, 'apiShow']);

    // Routes protégées par Laravel Sanctum (Écriture / Modification)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/entrepots', [EntrepotController::class, 'apiStore']);
        Route::put('/entrepots/{id}', [EntrepotController::class, 'apiUpdate']);
        Route::delete('/entrepots/{id}', [EntrepotController::class, 'apiDestroy']);
    });
});

// API EXTERNE (Destinée aux services tiers ou clients extérieurs)
Route::prefix('v1')->group(function () {

    // Routes publiques (Lecture)
    Route::get('/entrepots', [EntrepotController::class, 'apiIndex']);
    Route::get('/entrepots/{id}', [EntrepotController::class, 'apiShow']);

    // Routes protégées par Laravel Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/entrepots', [EntrepotController::class, 'apiStore']);
        Route::put('/entrepots/{id}', [EntrepotController::class, 'apiUpdate']);
        Route::delete('/entrepots/{id}', [EntrepotController::class, 'apiDestroy']);
    });
});
