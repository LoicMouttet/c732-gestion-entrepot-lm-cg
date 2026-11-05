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

<!-- HEADER GLOBAL -->
<header class="bg-white border-b border-gray-200 px-10 py-6 flex justify-between items-center relative shadow-sm z-40">
    <div class="flex items-center gap-5">
        <a href="{{ route('home') }}" class="flex items-center">
            <!-- Logo LogiFlex -->
            <img src="{{ asset('images/Logo_LogiFlex.png') }}" alt="LogiFlex" class="h-16 w-auto object-contain">
        </a>
        <span class="text-sm text-gray-500 hidden md:inline font-medium pl-4 border-l border-gray-300">Réseau de stockage international</span>
    </div>

    <!-- Barre de recherche globale indépendante avec liens spécifiques -->
    <div class="hidden lg:flex items-center relative w-[420px]">
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

<!-- Script global (Menu Burger + Recherche globale avec les 6 entrepôts) -->
<script>
    function toggleUserMenu() {
        const menu = document.getElementById('userDropdown');
        menu.classList.toggle('hidden');
    }

    function handleGlobalSearch(query) {
        const resultsBox = document.getElementById('globalSearchResults');
        const listContainer = document.getElementById('searchResultsList');

        if (query.trim() === '') {
            resultsBox.classList.add('hidden');
            listContainer.innerHTML = '';
            return;
        }

        // Données reliées aux ID de la base de données (1 à 6)
        const mockDatabase = [
            { type: 'Entrepôt', name: 'Entrepôt A - Lyon Sud', detail: '123 Avenue de l’Industrie, Lyon', icon: 'fa-warehouse', url: "{{ url('/entrepots/1') }}" },
            { type: 'Entrepôt', name: 'Entrepôt B - Paris Nord', detail: '45 Rue de la Logistique, Paris', icon: 'fa-warehouse', url: "{{ url('/entrepots/2') }}" },
            { type: 'Entrepôt', name: 'Entrepôt C - Marseille Port', detail: '12 Boulevard des Docks, Marseille', icon: 'fa-warehouse', url: "{{ url('/entrepots/3') }}" },
            { type: 'Entrepôt', name: 'Entrepôt D - Lille Est', detail: '8 Zone Industrielle, Lille', icon: 'fa-warehouse', url: "{{ url('/entrepots/4') }}" },
            { type: 'Entrepôt', name: 'Entrepôt E - Bordeaux Ouest', detail: '14 Avenue du Vin, Bordeaux', icon: 'fa-warehouse', url: "{{ url('/entrepots/5') }}" },
            { type: 'Entrepôt', name: 'Entrepôt F - Strasbourg Centre', detail: '3 Rue de l’Europe, Strasbourg', icon: 'fa-warehouse', url: "{{ url('/entrepots/6') }}" },

            { type: 'Article', name: 'Palettes Europe (REF-1029)', detail: 'Quantité: 120 pcs - Entrepôt A (Lyon Sud)', icon: 'fa-box', url: "{{ url('/entrepots/1') }}" },
            { type: 'Article', name: 'Cartons de transport (REF-8492)', detail: 'Quantité: 450 pcs - Entrepôt B (Paris Nord)', icon: 'fa-box', url: "{{ url('/entrepots/2') }}" }
        ];

        const filtered = mockDatabase.filter(item =>
            item.name.toLowerCase().includes(query.toLowerCase()) ||
            item.detail.toLowerCase().includes(query.toLowerCase())
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
                                <div class="text-xs font-bold text-gray-800">${item.name} <span class="text-[10px] font-normal text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded ml-1">${item.type}</span></div>
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
