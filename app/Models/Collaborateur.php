<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'motDePasse',
        'role',
        'entreprise_cliente_id',
    ];

    public function entrepriseCliente()
    {
        return $this->belongsTo(EntrepriseCliente::class);
    }
}
