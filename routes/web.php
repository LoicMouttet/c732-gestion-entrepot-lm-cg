<?php

use Illuminate\Support\Facades\Route;

// Liste centralisée des 6 entrepôts fictifs
$entrepots = [
    'lyon-sud' => [
        'id' => 'lyon-sud',
        'nom' => 'Entrepôt A - Lyon Sud',
        'adresse' => '123 Avenue de l’Industrie, 69000 Lyon',
        'image' => asset('images/Logo_LogiFlex.png')
    ],
    'paris-nord' => [
        'id' => 'paris-nord',
        'nom' => 'Entrepôt B - Paris Nord',
        'adresse' => '45 Rue de la Logistique, 75018 Paris',
        'image' => asset('images/Logo_LogiFlex.png')
    ],
    'marseille-port' => [
        'id' => 'marseille-port',
        'nom' => 'Entrepôt C - Marseille Port',
        'adresse' => '12 Boulevard des Docks, 13002 Marseille',
        'image' => asset('images/Logo_LogiFlex.png')
    ],
    'lille-est' => [
        'id' => 'lille-est',
        'nom' => 'Entrepôt D - Lille Est',
        'adresse' => '8 Zone Industrielle, 59000 Lille',
        'image' => asset('images/Logo_LogiFlex.png')
    ],
    'bordeaux-ouest' => [
        'id' => 'bordeaux-ouest',
        'nom' => 'Entrepôt E - Bordeaux Ouest',
        'adresse' => '14 Avenue du Vin, 33000 Bordeaux',
        'image' => asset('images/Logo_LogiFlex.png')
    ],
    'strasbourg-centre' => [
        'id' => 'strasbourg-centre',
        'nom' => 'Entrepôt F - Strasbourg Centre',
        'adresse' => '3 Rue de l’Europe, 67000 Strasbourg',
        'image' => asset('images/Logo_LogiFlex.png')
    ]
];

// Page d'accueil : Liste des 6 entrepôts
Route::get('/', function () use ($entrepots) {
    return view('entrepots.index', compact('entrepots'));
});

Route::get('/entrepots', function () use ($entrepots) {
    return view('entrepots.index', compact('entrepots'));
});

// Vue détaillée d'un entrepôt spécifique (dynamique)
Route::get('/entrepots/{id}', function ($id) use ($entrepots) {
    $entrepot = $entrepots[$id] ?? [
        'id' => $id,
        'nom' => 'Entrepôt Spécifique (' . ucfirst($id) . ')',
        'adresse' => 'Adresse non renseignée'
    ];
    return view('entrepots.show', compact('entrepot'));
});

// Route de Connexion / Déconnexion (Prototype)
Route::get('/login', function () {
    return view('auth.login');
});
