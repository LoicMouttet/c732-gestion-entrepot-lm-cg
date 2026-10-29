<?php

namespace Database\Factories;

use App\Models\EntrepriseCliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseClienteFactory extends Factory
{
    protected $model = EntrepriseCliente::class;

    public function definition(): array
    {
        return [
            'raisonSociale' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'telephone' => $this->faker->phoneNumber(),
        ];
    }
}
