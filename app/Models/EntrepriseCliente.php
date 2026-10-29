<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EntrepriseCliente extends Model
{
    use HasFactory;

    protected $table = 'entreprise_clientes';

    protected $fillable = [
        'raisonSociale',
        'email',
        'telephone',
    ];

    /**
     * Relation : Une entreprise emploie plusieurs collaborateurs.
     */
    public function collaborateurs(): HasMany
    {
        return $this->hasMany(Collaborateur::class);
    }

    /**
     * Relation : Une entreprise loue plusieurs stocks.
     */
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
