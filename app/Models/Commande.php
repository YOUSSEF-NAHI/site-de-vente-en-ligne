<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\LigneCommande;
use App\Models\Produit;

class Commande extends Model
{
    use HasFactory;

    /**
     * The products that belong to the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'LigneCommande', 'commande_id', 'produit_id')
                    ->using(LigneCommande::class)
                    ->as('LigneCommande')
                    ->withPivot('prixTotal', 'quantite')
                    ->withTimestamps();
    }
}
