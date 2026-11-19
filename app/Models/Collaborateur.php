<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Collaborateur extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'collaborateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'motDePasse',
        'role',
    ];

    protected $hidden = [
        'motDePasse',
    ];

    // Indique à Laravel quelle colonne contient le mot de passe
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }
}
