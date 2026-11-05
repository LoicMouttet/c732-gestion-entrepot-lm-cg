<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'dateMaj',
        'entreprise_cliente_id',
        'entrepot_id',
        'produit_id',
    ];

    // Calcul dynamique du statut en fonction de la quantité
    public function getStatutAttribute(): string
    {
        if ($this->quantite <= 0) {
            return 'Rupture de stock';
        } elseif ($this->quantite < 5) {
            return 'Stock bas';
        }
        return 'En Stock';
    }

    // Relations utiles
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class);
    }
}
