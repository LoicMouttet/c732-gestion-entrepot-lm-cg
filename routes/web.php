<?php

use Illuminate\Support\Facades\Route;

// Route pour la liste des entrepôts (page d'accueil)
Route::get('/entrepots', function () {
    return view('entrepots.index');
});

// Page de visualisation du stock pour un entrepôt spécifique
Route::get('/entrepots/{id}', function ($id) {
    return view('entrepots.show', ['id' => $id]);
});

// Route pour afficher la page de connexion (authentification)
Route::get('/login', function () {
    return view('auth.login');
});

