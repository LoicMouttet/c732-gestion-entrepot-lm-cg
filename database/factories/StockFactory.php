<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Produit;
use App\Models\Entrepot;
use App\Models\EntrepriseCliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition(): array
    {
        return [
            'quantite' => $this->faker->numberBetween(0, 150),
            'dateMaj' => now(),
            'produit_id' => Produit::inRandomOrder()->first()?->id ?? Produit::factory(),
            'entrepot_id' => Entrepot::inRandomOrder()->first()?->id ?? 1,
            // Récupère une entreprise cliente existante ou en crée une si la table est vide
            'entreprise_cliente_id' => EntrepriseCliente::inRandomOrder()->first()?->id ?? EntrepriseCliente::factory(),
        ];
    }
}
