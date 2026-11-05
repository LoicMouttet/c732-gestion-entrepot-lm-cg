<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogiFlex - Stock de {{ $entrepot->nom }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">📦 LogiFlex</a>
        <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">Retour à l'accueil</a>
    </div>
</nav>

<div class="container my-5">
    <!-- En-tête inspiré de la maquette -->
    <div class="mb-4">
        <h2 class="fw-bold">Page de Visualisation du Stock - {{ $entrepot->nom }}</h2>
        <p class="text-muted">📍 Adresse : {{ $entrepot->adresse }}, {{ $entrepot->codePostal }} {{ $entrepot->ville }} | Capacité totale : {{ $entrepot->capaciteTotale }}</p>
    </div>

    <!-- Barre de progression (Visuel stock) -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <span class="fw-bold">État du Remplissage</span>
                <span class="text-muted">Capacité maximale : {{ $entrepot->capaciteTotale }} unités</span>
            </div>
            <div class="progress" style="height: 25px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                    Place Empruntée (75%)
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des articles en stock -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-3">Articles stockés dans ce hangar</h4>
            @if($entrepot->stocks && $entrepot->stocks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th>Numéro d'Article</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Quantité</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entrepot->stocks as $stock)
                            <tr>
                                <td><code>{{ $stock->produit->reference ?? 'N/A' }}</code></td>
                                <td class="fw-bold">{{ $stock->produit->nom ?? 'N/A' }}</td>
                                <td>{{ $stock->produit->description ?? 'Aucune description' }}</td>
                                <td>{{ $stock->quantite }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mb-0">Aucun stock enregistré pour cet entrepôt pour le moment.</div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
