@extends('layouts.app')

@section('content')
    <!-- En-tête de la page de l'entrepôt -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <!-- Lien de retour corrigé avec url() de Laravel -->
            <a href="{{ url('/entrepots') }}" class="text-sm text-blue-600 hover:underline flex items-center gap-1 mb-2">
                <i class="fa-solid fa-arrow-left"></i> Retour aux entrepôts
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Visualisation du Stock - Entrepôt A (Lyon Sud)</h1>
            <p class="text-sm text-gray-500">123 Avenue de l'Industrie, 69000 Lyon</p>
        </div>

        <button class="bg-blue-900 hover:bg-blue-800 text-white text-sm px-4 py-2 rounded-md flex items-center gap-2 self-start md:self-auto transition">
            <i class="fa-solid fa-plus"></i> Ajouter un article
        </button>
    </div>

    <!-- Barre d'occupation de l'entrepôt -->
    <div class="bg-white rounded-lg shadow border border-gray-200 p-5 mb-8">
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-semibold text-gray-700">Taux d'occupation de l'entrepôt</span>
            <span class="text-sm font-bold text-blue-900">75% (7 500 / 10 000 m³)</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-blue-600 h-3 rounded-full" style="width: 75%"></div>
        </div>
    </div>

    <!-- Section Filtres & Recherche -->
    <div class="bg-white rounded-lg shadow border border-gray-200 p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Filtrer par nom / réf</label>
                <input type="text" placeholder="Ex: Palette bois..." class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Catégorie</label>
                <select class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">
                    <option value="">Toutes les catégories</option>
                    <option value="matériaux">Matériaux</option>
                    <option value="électronique">Électronique</option>
                    <option value="logistique">Emballage</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Statut du stock</label>
                <select class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="ok">En stock</option>
                    <option value="low">Stock bas</option>
                    <option value="empty">Rupture</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="w-full bg-gray-800 hover:bg-gray-700 text-white text-sm py-2 rounded-md font-medium transition">
                    Appliquer les filtres
                </button>
            </div>
        </div>
    </div>

    <!-- Tableau du Stock -->
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse text-sm">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 uppercase text-xs">
            <tr>
                <th class="py-3 px-4">Référence</th>
                <th class="py-3 px-4">Article</th>
                <th class="py-3 px-4">Catégorie</th>
                <th class="py-3 px-4">Emplacement</th>
                <th class="py-3 px-4 text-center">Quantité</th>
                <th class="py-3 px-4 text-center">Statut</th>
                <th class="py-3 px-4 text-right">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @php
                $articles = [
                    ['ref' => 'ART-001', 'nom' => 'Palettes Europe Bois', 'cat' => 'Emballage', 'emp' => 'Allée A - Travée 12', 'qte' => 450, 'status' => 'En stock', 'color' => 'bg-green-100 text-green-800'],
                    ['ref' => 'ART-002', 'nom' => 'Cartons Double Cannelure', 'cat' => 'Emballage', 'emp' => 'Allée B - Travée 04', 'qte' => 120, 'status' => 'Stock bas', 'color' => 'bg-yellow-100 text-yellow-800'],
                    ['ref' => 'ART-003', 'nom' => 'Bacs Plastiques Industriels', 'cat' => 'Stockage', 'emp' => 'Allée A - Travée 02', 'qte' => 0, 'status' => 'Rupture', 'color' => 'bg-red-100 text-red-800'],
                    ['ref' => 'ART-004', 'nom' => 'Film Étirable Transparent', 'cat' => 'Emballage', 'emp' => 'Allée C - Travée 01', 'qte' => 890, 'status' => 'En stock', 'color' => 'bg-green-100 text-green-800'],
                ];
            @endphp

            @foreach($articles as $art)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-4 font-mono font-medium text-gray-700">{{ $art['ref'] }}</td>
                    <td class="py-3 px-4 font-semibold text-gray-800">{{ $art['nom'] }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $art['cat'] }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $art['emp'] }}</td>
                    <td class="py-3 px-4 text-center font-bold text-gray-800">{{ $art['qte'] }}</td>
                    <td class="py-3 px-4 text-center">
                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $art['color'] }}">
                        {{ $art['status'] }}
                    </span>
                    </td>
                    <td class="py-3 px-4 text-right">
                        <button class="text-blue-600 hover:text-blue-800 mr-2 transition" title="Éditer">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-800 transition" title="Supprimer">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
