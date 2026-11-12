<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Exemple de route API pour récupérer tous les entrepôts (accessible via /api/entrepots)
Route::get('/entrepots', [EntrepotController::class, 'apiIndex']);

// Exemple pour un entrepôt spécifique avec ses stocks (/api/entrepots/{id})
Route::get('/entrepots/{id}', [EntrepotController::class, 'apiShow']);
