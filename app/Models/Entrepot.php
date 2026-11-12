<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrepot extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
        'codePostal',
        'ville',
        'capaciteTotale',
    ];

    /**
    - Relation : Un entrepôt contient plusieurs stocks.
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
