<?php

namespace App\Http\Controllers;

use App\Models\Entrepot;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class EntrepotController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $resultats = null;

        // Récupération de tous les entrepôts pour la grille d'accueil
        $entrepots = Entrepot::all();

        // Coordonnées GPS des villes des entrepôts pour interroger l'API météo
        $coordsParVille = [
            'Lille'     => ['lat' => 50.6292, 'lon' => 3.0573],
            'Paris'     => ['lat' => 48.8566, 'lon' => 2.3522],
            'Nantes'    => ['lat' => 47.2184, 'lon' => -1.5536],
            'Lyon'      => ['lat' => 45.7640, 'lon' => 4.8357],
            'Marseille' => ['lat' => 43.2965, 'lon' => 5.3698],
            'Bordeaux'  => ['lat' => 44.8378, 'lon' => -0.5792],
        ];

        // Récupération de la température actuelle pour chaque entrepôt
        foreach ($entrepots as $entrepot) {
            $ville = $this->detecterVille($entrepot->nom ?? '');
            $entrepot->temperature = null;

            if ($ville && isset($coordsParVille[$ville])) {
                $lat = $coordsParVille[$ville]['lat'];
                $lon = $coordsParVille[$ville]['lon'];

                $entrepot->temperature = Cache::remember("meteo_entrepot_{$ville}", now()->addMinutes(15), function () use ($lat, $lon) {
                    try {
                        $response = Http::timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
                            'latitude' => $lat,
                            'longitude' => $lon,
                            'current' => 'temperature_2m',
                        ]);

                        if ($response->successful()) {
                            return $response->json('current.temperature_2m');
                        }
                    } catch (\Throwable $e) {
                        return null;
                    }

                    return null;
                });
            }
        }

        // Si une recherche globale est effectuée
        if ($search) {
            $resultats = Stock::with(['produit', 'entrepot', 'entrepriseCliente'])
                ->whereHas('produit', function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('reference', 'like', "%{$search}%");
                })
                ->get();
        }

        // CORRECTION ICI : On pointe vers 'entrepots.index' au lieu de 'OLD_home'
        return view('entrepots.index', compact('entrepots', 'resultats', 'search'));
    }

    /**
     * Détecte la ville associée à partir du nom de l'entrepôt
     */
    private function detecterVille(string $nom): ?string
    {
        foreach (['Lille', 'Paris', 'Nantes', 'Lyon', 'Marseille', 'Bordeaux'] as $ville) {
            if (str_contains($nom, $ville)) {
                return $ville;
            }
        }

        if (str_contains($nom, 'Île-de-France') || str_contains($nom, 'Ile-de-France')) {
            return 'Paris';
        }

        return null;
    }

    public function show($id)
    {
        $entrepot = Entrepot::with('stocks.produit')->findOrFail($id);

        // CORRECTION ICI : On pointe vers 'entrepots.show' au lieu de 'OLD_show'
        return view('entrepots.show', compact('entrepot'));
    }

    // ==========================================
    // MÉTHODES POUR L'API (Interne & Externe)
    // ==========================================

    /**
     * API : Récupérer la liste de tous les entrepôts avec leurs stocks
     */
    public function apiIndex()
    {
        $entrepots = Entrepot::with('stocks.produit')->get();

        return response()->json([
            'success' => true,
            'data' => $entrepots
        ], 200);
    }

    /**
     * API : Récupérer un entrepôt spécifique par son ID
     */
    public function apiShow($id)
    {
        $entrepot = Entrepot::with('stocks.produit')->find($id);

        if (!$entrepot) {
            return response()->json([
                'success' => false,
                'message' => 'Entrepôt non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $entrepot
        ], 200);
    }
}
