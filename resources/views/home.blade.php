<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogiFlex - Gestion d'Entrepôt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">📦 LogiFlex</a>
    </div>
</nav>

<div class="container my-5">
    <!-- Barre de Recherche Globale -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 text-center">
                    <h3 class="mb-3">Recherche rapide d'article</h3>
                    <form action="{{ route('home') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control form-control-lg"
                               placeholder="Rechercher par nom d'article ou référence (ex: ART-1484)..."
                               value="{{ $search }}">
                        <button type="submit" class="btn btn-primary btn-lg px-4">Rechercher</button>
                        @if($search)
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">Réinitialiser</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Résultats de la recherche globale (si active) -->
    @if($search)
        <div class="mb-5">
            <h4 class="mb-3">Résultats pour « {{ $search }} »</h4>
            @if($resultats && $resultats->count() > 0)
                <div class="table-responsive bg-white rounded shadow-sm p-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th>Référence</th>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Statut</th>
                            <th>Emplacement (Hangar)</th>
                            <th>Client</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($resultats as $stock)
                            <tr>
                                <td><code>{{ $stock->produit->reference }}</code></td>
                                <td class="fw-bold">{{ $stock->produit->nom }}</td>
                                <td>{{ $stock->quantite }}</td>
                                <td>
                                    @if($stock->statut === 'Rupture de stock')
                                        <span class="badge bg-danger">Rupture de stock</span>
                                    @elseif($stock->statut === 'Stock bas')
                                        <span class="badge bg-warning text-dark">Stock bas</span>
                                    @else
                                        <span class="badge bg-success">En Stock</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-info text-dark">{{ $stock->entrepot->nom }}</span></td>
                                <td>{{ $stock->entrepriseCliente->raisonSociale ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning">Aucun article trouvé pour cette recherche.</div>
            @endif
        </div>
    @endif

    <!-- Grille des Hangars / Entrepôts -->
    <h3 class="mb-4">Liste des Hangars</h3>
    <div class="row g-4">
        @foreach($entrepots as $entrepot)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-primary">{{ $entrepot->nom }}</h5>
                        <p class="card-text text-muted mb-1">📍 {{ $entrepot->adresse }}</p>
                        <p class="card-text text-muted">🏙️ {{ $entrepot->codePostal }} {{ $entrepot->ville }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="#" class="btn btn-outline-primary w-100">Accéder au hangar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
