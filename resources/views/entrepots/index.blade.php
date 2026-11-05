@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Page d'Accueil : Vos Entrepôts</h1>
    </div>

    @php
        // Liste des entrepôts dynamique pour générer la grille de la maquette
        $entrepots = [
            ['id' => 1, 'nom' => 'Entrepôt A - Lyon Sud', 'adresse' => '123 Avenue de l\'Industrie, 69000 Lyon'],
            ['id' => 2, 'nom' => 'Entrepôt B - Lyon Sud', 'adresse' => '123 Avenue de l\'Industrie, 69000 Lyon'],
            ['id' => 3, 'nom' => 'Entrepôt C - Lyon Sud', 'adresse' => '123 Avenue de l\'Industrie, 69000 Lyon'],
            ['id' => 4, 'nom' => 'Entrepôt D - Lyon Sud', 'adresse' => '123 Avenue de l\'Industrie, 69000 Lyon'],
            ['id' => 5, 'nom' => 'Entrepôt E - Lyon Sud', 'adresse' => '123 Avenue de l\'Industrie, 69000 Lyon'],
            ['id' => 6, 'nom' => 'Entrepôt F - Lyon Sud', 'adresse' => '123 Avenue de l\'Industrie, 69000 Lyon'],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($entrepots as $entrepot)
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <!-- Image de la maquette de l'entrepôt -->
                    <img src="{{ asset('images/entrepot-maquette.jpg') }}" alt="Visuel de l'entrepôt" class="w-full h-40 object-cover">

                    <!-- Informations -->
                    <div class="p-4 text-center">
                        <h2 class="font-bold text-gray-800 text-lg">{{ $entrepot['nom'] }}</h2>
                        <p class="text-xs text-gray-500 mt-1">{{ $entrepot['adresse'] }}</p>
                    </div>
                </div>

                <!-- Bouton d'action dynamique pointant vers la vue de stock correspondante -->
                <div class="p-4 pt-0 text-center">
                    <a href="{{ url('/entrepots/' . $entrepot['id']) }}" class="inline-block w-full bg-blue-900 hover:bg-blue-800 text-white text-sm font-semibold py-2 rounded-md transition shadow-sm">
                        Visualiser le stock
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
