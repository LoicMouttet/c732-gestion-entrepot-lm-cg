<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EntrepotController;

// 1. Page d'accueil (URL racine '/') : Affiche la page de connexion
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Page de connexion alternative
Route::get('/login', function () {
    return view('auth.login');
});

// Traitement du formulaire de connexion web
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/entrepots');
    }

    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ])->onlyInput('email');
});

// Déconnexion
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// 2. Routes protégées (nécessite d'être connecté en session web)
Route::middleware('auth')->group(function () {
    Route::get('/entrepots', [EntrepotController::class, 'index'])->name('home');
    Route::get('/entrepots/{id}', [EntrepotController::class, 'show'])->name('entrepots.show');
});
