<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Collaborateur;
use App\Http\Controllers\EntrepotController;

// Page d'accueil (URL racine '/') : Affiche la page de connexion
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Page de connexion alternative
Route::get('/login', function () {
    return view('auth.login');
});

// Traitement du formulaire de connexion web (Email ou Nom d'utilisateur)
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => ['required', 'string'],
        'password' => ['required'],
    ], [
        'email.required' => "L'identifiant ou l'adresse email est obligatoire.",
        'password.required' => 'Le mot de passe est obligatoire.',
    ]);

    $identifiant = trim($request->email);

    $collaborateur = Collaborateur::where('email', $identifiant)
        ->orWhere('nomuser', strtolower($identifiant))
        ->first();

    $motDePasseValide = false;
    if ($collaborateur) {
        $storedPassword = (string) $collaborateur->motDePasse;
        $estUnHash = preg_match('/^\$(2[ayb]|argon2[id])\$/', $storedPassword) === 1;

        if ($estUnHash) {
            $motDePasseValide = Hash::check($request->password, $storedPassword);
        } else {
            $motDePasseValide = hash_equals($storedPassword, (string) $request->password);
        }
    }

    if (! $collaborateur || ! $motDePasseValide) {
        return back()->withErrors([
            'email' => 'Identifiant / email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    Auth::login($collaborateur, $request->boolean('remember'));
    $request->session()->regenerate();

    return redirect()->intended('/entrepots');
});

// Déconnexion
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Routes protégées (nécessite d'être connecté en session web)
Route::middleware('auth')->group(function () {
    Route::get('/entrepots', [EntrepotController::class, 'index'])->name('home');
    Route::get('/entrepots/{id}', [EntrepotController::class, 'show'])->name('entrepots.show');
});
