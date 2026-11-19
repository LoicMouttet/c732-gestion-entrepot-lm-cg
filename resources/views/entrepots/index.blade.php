@extends('layouts.app')

@section('content')
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

    <div class="bg-logistics-fullwidth py-12 px-6 md:px-12 my-[-1.5rem]">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @php
                    $catalogueImages = [
                        'bordeaux'      => asset('images/Entrepot.Bordeaux.jpg'),
                        'ile-de-france' => asset('images/Entrepot.IleDeFrance.jpg'),
                        'lille'         => asset('images/Entrepot.Lille.jpg'),
                        'lyon'          => asset('images/Entrepot.Lyon.jpg'),
                        'marseille'     => asset('images/Entrepot.Marseille.jpg'),
                        'nantes'        => asset('images/Entrepot.Nantes.jpg'),
                    ];

                    $fallbackList = array_values($catalogueImages);

                    $getEntrepotImage = function ($nom, $index) use ($catalogueImages, $fallbackList) {
                        $nomClean = mb_strtolower($nom, 'UTF-8');
                        $nomClean = str_replace(['î', 'ï'], 'i', $nomClean);
                        $nomClean = str_replace(' ', '-', $nomClean);

                        foreach ($catalogueImages as $cle => $chemin) {
                            if (str_contains($nomClean, $cle)) {
                                return $chemin;
                            }
                        }

                        return $fallbackList[$index % count($fallbackList)];
                    };
                @endphp

                @foreach($entrepots as $index => $entrepot)
                    @php
                        $nomEntrepot = is_array($entrepot) ? $entrepot['nom'] : $entrepot->nom;
                        $adresseEntrepot = is_array($entrepot) ? $entrepot['adresse'] : $entrepot->adresse;
                        $idEntrepot = is_array($entrepot) ? $entrepot['id'] : $entrepot->id;
                        $temperatureEntrepot = is_array($entrepot) ? ($entrepot['temperature'] ?? null) : ($entrepot->temperature ?? null);
                        $currentImage = $getEntrepotImage($nomEntrepot, $index);
                    @endphp

                    <div class="bg-white rounded-2xl border border-gray-200 shadow-xl overflow-hidden flex flex-col justify-between hover:shadow-2xl transition-all duration-300 group">
                        <div>
                            <div class="h-48 w-full overflow-hidden bg-gray-100 relative">
                                <img src="{{ $currentImage }}" alt="{{ $nomEntrepot }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>

                            <div class="p-5 space-y-1">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-bold text-base text-gray-900">{{ $nomEntrepot }}</h3>

                                    @if(!is_null($temperatureEntrepot))
                                        <span class="shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-[#1e3a8a] border border-blue-200">
                                            <i class="fa-solid fa-temperature-half mr-1"></i>{{ round($temperatureEntrepot, 1) }} °C
                                        </span>
                                    @else
                                        <span class="shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                            N/A
                                        </span>
                                    @endif
                                </div>

                                <p class="text-xs text-gray-500"><i class="fa-solid fa-location-dot mr-1.5 text-gray-400"></i>{{ $adresseEntrepot }}</p>
                            </div>
                        </div>

                        <div class="p-5 pt-0">
                            <div class="pt-2">
                                <a href="{{ url('/entrepots/' . $idEntrepot) }}" class="block w-full text-center bg-[#1e3a8a] hover:bg-[#172554] text-white font-medium py-2.5 px-4 rounded-xl text-xs transition-all shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
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
