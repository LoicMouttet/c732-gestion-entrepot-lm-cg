<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepotController;

// Page d'accueil : Liste des entrepôts gérée par le contrôleur et la BDD
Route::get('/', [EntrepotController::class, 'index'])->name('home');

// Vue détaillée d'un entrepôt spécifique (dynamique via la BDD)
Route::get('/entrepots/{id}', [EntrepotController::class, 'show'])->name('entrepots.show');

// Route de Connexion (Intégration Frontend)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');