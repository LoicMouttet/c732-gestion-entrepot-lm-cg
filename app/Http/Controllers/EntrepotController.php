<?php

namespace App\Http\Controllers;

use App\Models\Entrepot;
use App\Models\Stock;
use Illuminate\Http\Request;

class EntrepotController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $resultats = null;

        // Récupération de tous les entrepôts pour la grille d'accueil
        $entrepots = Entrepot::all();

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
