<?php

namespace Database\Seeders;

use App\Models\Entrepot;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Déclaration des 6 entrepôts dans différentes villes de France
        $entrepots = [
            [
                'nom' => 'Entrepôt Nord - Lille',
                'adresse' => '45 Rue de la Logistique',
                'codePostal' => '59000',
                'ville' => 'Lille',
                'capaciteTotale' => 5000,
            ],
            [
                'nom' => 'Entrepôt Île-de-France',
                'adresse' => '12 Zone Industrielle Est',
                'codePostal' => '93200',
                'ville' => 'Saint-Denis',
                'capaciteTotale' => 8000,
            ],
            [
                'nom' => 'Entrepôt Ouest - Nantes',
                'adresse' => '8 Boulevard des Transports',
                'codePostal' => '44000',
                'ville' => 'Nantes',
                'capaciteTotale' => 4500,
            ],
            [
                'nom' => 'Entrepôt Centre - Lyon',
                'adresse' => '15 Rue du Commerce',
                'codePostal' => '69007',
                'ville' => 'Lyon',
                'capaciteTotale' => 6000,
            ],
            [
                'nom' => 'Entrepôt Sud - Marseille',
                'adresse' => '78 Avenue du Port',
                'codePostal' => '13002',
                'ville' => 'Marseille',
                'capaciteTotale' => 7000,
            ],
            [
                'nom' => 'Entrepôt Sud-Ouest - Bordeaux',
                'adresse' => '33 Rue de l\'Aéronautique',
                'codePostal' => '33000',
                'ville' => 'Bordeaux',
                'capaciteTotale' => 5500,
            ],
        ];

        foreach ($entrepots as $entrepot) {
            Entrepot::create($entrepot);
        }

        // 2. Exécution des autres factories pour les clients, produits, collaborateurs et stock
        \App\Models\EntrepriseCliente::factory(10)->create();
        \App\Models\Collaborateur::factory(10)->create();
        \App\Models\Produit::factory(100)->create();
        \App\Models\Stock::factory(100)->create();
    }
}
