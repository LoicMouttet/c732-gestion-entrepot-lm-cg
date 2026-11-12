@extends('layouts.app')

@section('content')
    <!-- Style pour l'arrière-plan global validé -->
    <style>
        .bg-logistics-fullwidth {
            background-image: linear-gradient(to bottom right, rgba(15, 23, 42, 0.95), rgba(30, 58, 138, 0.91)),
            url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }
    </style>

    <!-- Conteneur pleine largeur -->
    <div class="bg-logistics-fullwidth py-12 px-6 md:px-12 my-[-1.5rem]">
        <div class="max-w-7xl mx-auto">

            <!-- Grille des Entrepôts -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @php
                    // Association directe basée sur le nom exact du fichier et de l'entrepôt
                    $getEntrepotImage = function($nom) {
                        $nomLower = strtolower($nom);

                        if (str_contains($nomLower, 'bordeaux')) {
                            return asset('images/Entrepot.Bordeaux.jpg');
                        } elseif (str_contains($nomLower, 'ile-de-france') || str_contains($nomLower, 'île-de-france')) {
                            return asset('images/Entrepot.IleDeFrance.jpg');
                        } elseif (str_contains($nomLower, 'lille')) {
                            return asset('images/Entrepot.Lille.jpg');
                        } elseif (str_contains($nomLower, 'lyon')) {
                            return asset('images/Entrepot.Lyon.jpg');
                        } elseif (str_contains($nomLower, 'marseille')) {
                            return asset('images/Entrepot.Marseille.jpg');
                        } elseif (str_contains($nomLower, 'nantes')) {
                            return asset('images/Entrepot.Nantes.jpg');
                        } else {
                            return asset('images/Entrepot.Lille.jpg');
                        }
                    };
                @endphp

                @foreach($entrepots as $entrepot)
                    @php
                        $currentImage = $getEntrepotImage($entrepot['nom']);
                    @endphp

                        <!-- Carte Blanche Pro -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-xl overflow-hidden flex flex-col justify-between hover:shadow-2xl transition-all duration-300 group">
                        <div>
                            <!-- Image unique locale de l'entrepôt -->
                            <div class="h-48 w-full overflow-hidden bg-gray-100 relative">
                                <img src="{{ $currentImage }}" alt="{{ $entrepot['nom'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>

                            <!-- Informations de l'entrepôt -->
                            <div class="p-5 space-y-1">
                                <h3 class="font-bold text-base text-gray-900">{{ $entrepot['nom'] }}</h3>
                                <p class="text-xs text-gray-500"><i class="fa-solid fa-location-dot mr-1.5 text-gray-400"></i>{{ $entrepot['adresse'] }}</p>
                            </div>
                        </div>

                        <!-- Bouton d'action -->
                        <div class="p-5 pt-0">
                            <div class="pt-2">
                                <a href="{{ url('/entrepots/' . $entrepot['id']) }}" class="block w-full text-center bg-[#1e3a8a] hover:bg-[#172554] text-white font-medium py-2.5 px-4 rounded-xl text-xs transition-all shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                                    <span>Visualiser le stock</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
