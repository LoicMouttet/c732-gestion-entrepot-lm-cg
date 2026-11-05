<?php

namespace Database\Factories;

use App\Models\Collaborateur;
use App\Models\EntrepriseCliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaborateurFactory extends Factory
{
    protected $model = Collaborateur::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'motDePasse' => bcrypt('password'),
            'role' => $this->faker->randomElement(['Gestionnaire', 'Responsable Stock', 'Logistique']),
            'entreprise_cliente_id' => EntrepriseCliente::factory(),
        ];
    }
}
