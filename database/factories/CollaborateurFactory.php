<?php

namespace Database\Factories;

use App\Models\Collaborateur;
use App\Models\EntrepriseCliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CollaborateurFactory extends Factory
{
    protected $model = Collaborateur::class;

    public function definition(): array
    {
        // Utilise la locale française
        $faker = \Faker\Factory::create('fr_FR');

        $prenom = $faker->firstName();
        $nom = $faker->lastName();

        // Génère un email propre basé SUR ce prénom et ce nom
        $email = Str::slug($prenom) . '.' . Str::slug($nom) . '@example.com';

        return [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => strtolower($email),
            'motDePasse' => bcrypt('1234'),
            'role' => $faker->randomElement(['Gestionnaire', 'Magasinier', 'Administrateur']),
            'entreprise_cliente_id' => EntrepriseCliente::inRandomOrder()->first()?->id ?? EntrepriseCliente::factory(),
        ];
    }
}
