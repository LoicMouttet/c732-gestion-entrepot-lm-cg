<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepotController;

// 1. Page d'accueil : Liste dynamique des entrepôts
Route::get('/', [EntrepotController::class, 'index'])->name('home');

// 2. Redirection optionnelle /entrepots vers la page d'accueil
Route::get('/entrepots', [EntrepotController::class, 'index']);

// 3. Vue détaillée d'un entrepôt (dynamique via la BDD)
Route::get('/entrepots/{id}', [EntrepotController::class, 'show'])->name('entrepots.show');

// 4. Page de connexion
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
