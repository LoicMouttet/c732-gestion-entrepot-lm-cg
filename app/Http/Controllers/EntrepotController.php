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

        return view('home', compact('entrepots', 'resultats', 'search'));
    }

    public function show($id)
    {
        $entrepot = Entrepot::with('stocks.produit')->findOrFail($id);

        return view('show', compact('entrepot'));
    }
}
