<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $data = $view->getData();

            // Entrepôts
            $entrepots = $data['entrepots'] ?? collect();
            if (empty($entrepots) || (is_countable($entrepots) && count($entrepots) === 0)) {
                foreach ([\App\Models\Entrepot::class, \App\Models\Warehouse::class] as $model) {
                    if (class_exists($model)) {
                        $entrepots = $model::all();
                        break;
                    }
                }
            }

            // Lignes de stock (1 entrée par stock = bon entrepôt + bon ID de ligne)
            $stocks = $data['stocks'] ?? collect();
            if ((empty($stocks) || (is_countable($stocks) && count($stocks) === 0)) && class_exists(\App\Models\Stock::class)) {
                $stocks = \App\Models\Stock::with(['produit', 'entrepot'])->get();
            }

            // Zones (si tu as un modèle Zone)
            $zones = $data['zones'] ?? collect();
            if ((empty($zones) || (is_countable($zones) && count($zones) === 0)) && class_exists(\App\Models\Zone::class)) {
                $zones = \App\Models\Zone::all();
            }

            $view->with([
                'globalSearchEntrepots' => $entrepots,
                'globalSearchStocks'    => $stocks,
                'globalSearchZones'     => $zones,
            ]);
        });
    }
}
