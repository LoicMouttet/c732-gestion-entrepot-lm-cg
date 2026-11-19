<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogiFlex - Réseau de stockage international</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col font-sans">

@php
    $hideGlobalSearch = request()->routeIs('entrepots.show') || request()->is('entrepots/*');
@endphp

    <!-- HEADER GLOBAL -->
<header class="bg-white border-b border-gray-200 px-10 py-6 flex justify-between items-center relative shadow-sm z-40">
    <div class="flex items-center gap-5">
        <a href="{{ route('home') }}" class="flex items-center">
            <!-- Logo LogiFlex -->
            <img src="{{ asset('images/Logo_LogiFlex.png') }}" alt="LogiFlex" class="h-16 w-auto object-contain">
        </a>
        <span class="text-sm text-gray-500 hidden md:inline font-medium pl-4 border-l border-gray-300">Réseau de stockage international</span>
    </div>

    <!-- Barre de recherche globale indépendante centrée avec liens spécifiques -->
    @unless($hideGlobalSearch)
        <div class="hidden xl:flex items-center justify-center absolute left-1/2 -translate-x-1/2 w-[420px]">
            <input type="text" id="globalSearchInput" oninput="handleGlobalSearch(this.value)" placeholder="Recherche globale (Entrepôt, zone, article...)" class="w-full bg-gray-50 border border-gray-300 rounded-full pl-5 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900 shadow-sm">
            <i class="fa-solid fa-magnifying-glass absolute right-4 text-gray-400 text-sm"></i>

            <!-- Panneau de résultats de la recherche globale -->
            <div id="globalSearchResults" class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-xl hidden py-2 z-50 text-sm max-h-80 overflow-y-auto">
                <div class="px-4 py-2 text-xs font-bold text-gray-400 uppercase">Résultats de la recherche globale</div>
                <div id="searchResultsList">
                    <!-- Les résultats interactifs s'injecteront ici -->
                </div>
            </div>
        </div>
    @endunless

    <!-- Menu Burger interactif -->
    <div class="relative">
        <button onclick="toggleUserMenu()" class="text-gray-700 hover:text-blue-900 text-2xl focus:outline-none p-2 rounded-lg hover:bg-gray-100 transition">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Menu déroulant -->
        <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden py-2 z-50 text-sm">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"><i class="fa-solid fa-warehouse mr-2"></i> Mes Entrepôts</a>
            <a href="{{ route('login') }}" class="block px-4 py-2 text-red-600 hover:bg-gray-100"><i class="fa-solid fa-right-from-bracket mr-2"></i> Déconnexion</a>
        </div>
    </div>
</header>

<!-- CONTENU PRINCIPAL -->
<main class="flex-1 max-w-7xl w-full mx-auto px-8 py-8">
    @yield('content')
</main>

<!-- FOOTER GLOBAL -->
<footer class="bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500">
    &copy; {{ date('Y') }} LogiFlex - Tous droits réservés.
</footer>

@php
    $globalItems = collect();
    $entrepotNames = [];
    $zoneToEntrepot = [];
    $defaultEntrepotId = null;

    if (! $hideGlobalSearch) {
        // 1. Entrepôts
        foreach ($globalSearchEntrepots ?? [] as $e) {
            $arr = is_array($e) ? $e : (method_exists($e, 'toArray') ? $e->toArray() : (array) $e);
            $id = $arr['id'] ?? null;
            if ($id && is_null($defaultEntrepotId)) {
                $defaultEntrepotId = $id;
            }
            $nom = $arr['nom'] ?? $arr['name'] ?? $arr['titre'] ?? '';
            $adresse = $arr['adresse'] ?? $arr['rue'] ?? $arr['zone'] ?? $arr['ville'] ?? '';

            if ($id && $nom !== '') {
                $entrepotNames[$id] = $nom;
            }

            $globalItems->push([
                'type'   => 'Entrepôt',
                'name'   => $nom,
                'detail' => $adresse,
                'icon'   => 'fa-warehouse',
                'url'    => $id ? url('/entrepots/' . $id) : route('home'),
            ]);
        }

        // 2. Zones
        foreach ($globalSearchZones ?? [] as $z) {
            $arr = is_array($z) ? $z : (method_exists($z, 'toArray') ? $z->toArray() : (array) $z);
            $id = $arr['id'] ?? null;
            $nom = $arr['nom'] ?? $arr['name'] ?? $arr['code'] ?? $arr['libelle'] ?? '';
            $rue = $arr['rue'] ?? $arr['adresse'] ?? $arr['description'] ?? '';
            $entrepotId = $arr['entrepot_id'] ?? $arr['warehouse_id'] ?? $defaultEntrepotId;

            if ($id && $entrepotId) {
                $zoneToEntrepot[$id] = $entrepotId;
            }

            $globalItems->push([
                'type'   => 'Zone',
                'name'   => $nom,
                'detail' => $rue,
                'icon'   => 'fa-layer-group',
                'url'    => $entrepotId ? url('/entrepots/' . $entrepotId) : route('home'),
            ]);
        }

        // 3. Articles via les lignes de stock (1 résultat distinct par entrepôt où l'article est présent)
        foreach ($globalSearchStocks ?? [] as $s) {
            $stockId = is_array($s) ? ($s['id'] ?? null) : ($s->id ?? null);
            $qte = is_array($s) ? ($s['quantite'] ?? null) : ($s->quantite ?? null);
            $emplacement = is_array($s) ? ($s['emplacement'] ?? null) : ($s->emplacement ?? null);
            $zoneId = is_array($s) ? ($s['zone_id'] ?? null) : ($s->zone_id ?? null);

            $entrepotObj = is_array($s) ? ($s['entrepot'] ?? null) : ($s->entrepot ?? null);
            $entrepotId = is_array($s)
                ? ($s['entrepot_id'] ?? ($entrepotObj['id'] ?? null))
                : ($s->entrepot_id ?? ($entrepotObj->id ?? null));

            $entrepotId = $entrepotId
                ?? ($zoneId && isset($zoneToEntrepot[$zoneId]) ? $zoneToEntrepot[$zoneId] : null)
                ?? $defaultEntrepotId;

            $entrepotNom = is_array($entrepotObj)
                ? ($entrepotObj['nom'] ?? null)
                : ($entrepotObj->nom ?? ($entrepotId && isset($entrepotNames[$entrepotId]) ? $entrepotNames[$entrepotId] : null));

            $produitObj = is_array($s) ? ($s['produit'] ?? null) : ($s->produit ?? null);
            $prodArr = $produitObj
                ? (is_array($produitObj) ? $produitObj : (method_exists($produitObj, 'toArray') ? $produitObj->toArray() : (array) $produitObj))
                : (is_array($s) ? $s : (method_exists($s, 'toArray') ? $s->toArray() : (array) $s));

            $nom = $prodArr['nom'] ?? $prodArr['name'] ?? $prodArr['designation'] ?? $prodArr['titre'] ?? '';
            $ref = $prodArr['reference'] ?? $prodArr['ref'] ?? $prodArr['code'] ?? '';

            $detailParties = array_filter([
                $entrepotNom ? $entrepotNom : null,
                $ref !== '' ? "Réf : $ref" : null,
                !is_null($qte) && $qte !== '' ? "Quantité : $qte pcs" : null,
                $emplacement ? $emplacement : null,
            ]);

            if ($nom !== '' || !empty($detailParties)) {
                $anchorId = $stockId ?? ($prodArr['id'] ?? null);
                $anchor = $anchorId ? '#article-' . $anchorId : '';
                $baseUrl = $entrepotId ? url('/entrepots/' . $entrepotId) : route('home');

                $globalItems->push([
                    'type'   => 'Article',
                    'name'   => $nom !== '' ? $nom : ($ref ?: "Article #$anchorId"),
                    'detail' => implode(' — ', $detailParties),
                    'icon'   => 'fa-box',
                    'url'    => $baseUrl . $anchor,
                ]);
            }
        }
    }
@endphp

    <!-- Script global (Menu Burger + Recherche globale) -->
<script>
    const GLOBAL_SEARCH_DATA = @json($globalItems->values()->all());

    function toggleUserMenu() {
        const menu = document.getElementById('userDropdown');
        menu.classList.toggle('hidden');
    }

    function handleGlobalSearch(query) {
        const resultsBox = document.getElementById('globalSearchResults');
        const listContainer = document.getElementById('searchResultsList');
        if (!resultsBox || !listContainer) return;

        const cleanQuery = query.trim().toLowerCase();

        if (cleanQuery === '') {
            resultsBox.classList.add('hidden');
            listContainer.innerHTML = '';
            return;
        }

        const filtered = GLOBAL_SEARCH_DATA.filter(item =>
            (item.name && item.name.toLowerCase().includes(cleanQuery)) ||
            (item.detail && item.detail.toLowerCase().includes(cleanQuery)) ||
            (item.type && item.type.toLowerCase().includes(cleanQuery))
        );

        listContainer.innerHTML = '';

        if (filtered.length > 0) {
            filtered.forEach(item => {
                listContainer.innerHTML += `
                    <a href="${item.url}" class="flex items-start px-4 py-2.5 hover:bg-gray-50 transition border-b border-gray-100 last:border-none">
                        <div class="bg-blue-50 text-blue-900 p-2 rounded-md mr-3 mt-0.5">
                            <i class="fa-solid ${item.icon} text-xs"></i>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-800">
                                ${item.name}
                                <span class="text-[10px] font-normal text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded ml-1">${item.type}</span>
                            </div>
                            <div class="text-xs text-gray-500">${item.detail}</div>
                        </div>
                    </a>
                `;
            });
        } else {
            listContainer.innerHTML = `<div class="px-4 py-3 text-xs text-gray-500 text-center">Aucun résultat trouvé pour "${query}"</div>`;
        }

        resultsBox.classList.remove('hidden');
    }

    // Fermer les menus si l'on clique ailleurs sur la page
    window.onclick = function(event) {
        if (!event.target.closest('button') && !event.target.closest('#userDropdown') && !event.target.closest('#globalSearchInput') && !event.target.closest('#globalSearchResults')) {
            const menu = document.getElementById('userDropdown');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
            const searchResults = document.getElementById('globalSearchResults');
            if (searchResults && !searchResults.classList.contains('hidden')) {
                searchResults.classList.add('hidden');
            }
        }
    }
</script>
</body>
</html>
