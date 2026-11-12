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

    /**
    - Calcul dynamique du statut en fonction de la quantité
     */
    public function getStatutAttribute(): string
    {
        if ($this->quantite <= 0) {
            return 'Rupture de stock';
        } elseif ($this->quantite < 5) {
            return 'Stock bas';
        }
        return 'En Stock';
    }

    /**
    - Relation : Un stock est associé à un produit.
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    /**
    - Relation : Un stock est rattaché à un entrepôt.
     */
    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class);
    }
}
