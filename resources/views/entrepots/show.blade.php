@extends('layouts.app')

@section('content')
    <!-- En-tête de la page de l'entrepôt -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $entrepot->nom }}</h1>
            <p class="text-sm text-gray-500"><i class="fa-solid fa-location-dot mr-1"></i> {{ $entrepot->adresse }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="text-sm text-blue-900 hover:underline bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Retour aux entrepôts
            </a>
            <button onclick="openAddModal()" class="bg-blue-900 hover:bg-blue-800 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Ajouter un article
            </button>
        </div>
    </div>

    <!-- Taux d'occupation -->
    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm mb-6">
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-medium text-gray-700">Taux d'occupation</span>
            <span class="text-sm font-bold text-gray-900">75%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
            <div class="bg-blue-900 h-2.5 rounded-full" style="width: 75%"></div>
        </div>
    </div>

    <!-- Barre d'outils (Recherche locale et Filtre par catégorie) -->
    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="relative w-full md:w-96">
            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Rechercher un article (nom ou référence)..." class="w-full bg-gray-50 border border-gray-300 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-gray-400 text-sm"></i>
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto justify-end">
            <select id="categoryFilter" onchange="filterTable()" class="bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
                <option value="">Toutes les catégories</option>
                <option value="Emballage">Emballage</option>
                <option value="Stockage">Stockage</option>
            </select>
        </div>
    </div>

    <!-- Tableau des stocks -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse" id="stockTable">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                <th class="py-3.5 px-6">Référence</th>
                <th class="py-3.5 px-6">Nom du Produit</th>
                <th class="py-3.5 px-6">Catégorie</th>
                <th class="py-3.5 px-6">Quantité</th>
                <th class="py-3.5 px-6">Emplacement</th>
                <th class="py-3.5 px-6 text-right">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
            @forelse($entrepot->stocks as $stock)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-4 px-6 font-medium text-blue-900">{{ $stock->produit->reference ?? 'N/A' }}</td>
                    <td class="py-4 px-6 font-medium text-gray-900">{{ $stock->produit->nom ?? 'Produit sans nom' }}</td>
                    <td class="py-4 px-6">
                        <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2.5 py-1 rounded">
                            {{ $stock->produit->categorie ?? 'Standard' }}
                        </span>
                    </td>
                    <td class="py-4 px-6 font-semibold">{{ $stock->quantite }} pcs</td>
                    <td class="py-4 px-6 text-gray-500">{{ $stock->emplacement ?? 'Non assigné' }}</td>
                    <td class="py-4 px-6 text-right space-x-3">
                        <button class="text-blue-600 hover:text-blue-900 transition"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-900 transition"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-500 text-sm">
                        Aucun article en stock pour le moment dans cet entrepôt.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- MODALE D'AJOUT / ÉDITION -->
    <div id="stockModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
                <h3 id="modalTitle" class="font-bold text-lg">Ajouter un article</h3>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 text-xl font-bold">&times;</button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Référence</label>
                    <input type="text" id="modalRef" placeholder="Ex: REF-9999" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nom du Produit</label>
                    <input type="text" id="modalName" placeholder="Ex: Conteneur acier" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Catégorie</label>
                    <select id="modalCategory" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <option value="Emballage">Emballage</option>
                        <option value="Stockage">Stockage</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Quantité</label>
                        <input type="number" id="modalQty" placeholder="Ex: 50" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Emplacement</label>
                        <input type="text" id="modalLocation" placeholder="Ex: Allée C - Travée 2" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-3 flex justify-end gap-3 border-t border-gray-200">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-lg transition">Annuler</button>
                <button onclick="saveStockItem()" class="px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white text-sm font-medium rounded-lg transition">Enregistrer</button>
            </div>
        </div>
    </div>

    <!-- MODALE DE SUPPRESSION -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm overflow-hidden text-center p-6">
            <div class="text-red-600 text-4xl mb-3"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3 class="font-bold text-lg text-gray-800 mb-2">Confirmer la suppression</h3>
            <p class="text-xs text-gray-500 mb-6">Êtes-vous sûr de vouloir supprimer <span id="deleteItemName" class="font-bold text-gray-700"></span> ? Cette action est irréversible.</p>
            <div class="flex justify-center gap-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-lg transition">Annuler</button>
                <button onclick="confirmDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">Supprimer</button>
            </div>
        </div>
    </div>

    <!-- Scripts pour la gestion du tableau et des modales -->
    <script>
        function filterTable() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const category = document.getElementById('categoryFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#stockTable tbody tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const rowCategory = row.children[2].innerText.toLowerCase();
                const matchesQuery = text.includes(query);
                const matchesCategory = category === "" || rowCategory.includes(category);

                if (matchesQuery && matchesCategory) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function openAddModal() {
            document.getElementById('modalTitle').innerText = "Ajouter un article";
            document.getElementById('modalRef').value = "";
            document.getElementById('modalName').value = "";
            document.getElementById('modalQty').value = "";
            document.getElementById('modalLocation').value = "";
            document.getElementById('stockModal').classList.remove('hidden');
        }

        function openEditModal(name, ref, category, qty, location) {
            document.getElementById('modalTitle').innerText = "Modifier l'article";
            document.getElementById('modalRef').value = ref;
            document.getElementById('modalName').value = name;
            document.getElementById('modalCategory').value = category;
            document.getElementById('modalQty').value = qty;
            document.getElementById('modalLocation').value = location;
            document.getElementById('stockModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('stockModal').classList.add('hidden');
        }

        function openDeleteModal(name) {
            document.getElementById('deleteItemName').innerText = name;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function saveStockItem() {
            alert("Action simulée enregistrée avec succès !");
            closeModal();
        }

        function confirmDelete() {
            alert("Article supprimé avec succès !");
            closeDeleteModal();
        }
    </script>
@endsection
