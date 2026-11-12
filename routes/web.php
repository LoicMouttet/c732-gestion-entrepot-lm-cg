<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepotController;

// 1. Page d'accueil (URL racine '/') : Affiche directement la page de connexion
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// 2. Liste dynamique des entrepôts (accessible après la connexion)
Route::get('/entrepots', [EntrepotController::class, 'index'])->name('home');

// 3. Vue détaillée d'un entrepôt (dynamique via la BDD)
Route::get('/entrepots/{id}', [EntrepotController::class, 'show'])->name('entrepots.show');

// 4. Page de connexion alternative
Route::get('/login', function () {
    return view('auth.login');
});
