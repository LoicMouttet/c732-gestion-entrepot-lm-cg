@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Page d'Accueil : Vos Entrepôts</h1>
        <p class="text-sm text-gray-500">Sélectionnez un entrepôt pour visualiser et gérer son stock.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($entrepots as $entrepot)
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col justify-between overflow-hidden">
                <div class="p-6 text-center">
                    <span class="text-xs text-gray-400 block mb-4">Visuel de l'entrepôt</span>

                    <h2 class="text-lg font-bold text-gray-900 mb-1">{{ $entrepot['nom'] }}</h2>
                    <p class="text-xs text-gray-500 mb-6">{{ $entrepot['adresse'] }}</p>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <a href="{{ url('/entrepots/' . $entrepot['id']) }}" class="block w-full text-center bg-blue-900 hover:bg-blue-800 text-white font-medium py-2.5 px-4 rounded-md text-sm transition">
                        Visualiser le stock
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
