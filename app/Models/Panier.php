<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PanierProduit;
use App\Models\Produit;

class Panier extends Model
{
    use HasFactory;

    /**
     * The products that belong to the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'panier_produit', 'panier_id', 'produit_id')
                    ->using(PanierProduit::class)
                    ->as('demande')
                    ->withPivot('prixTotal', 'quantite')
                    ->withTimestamps();
    }
}
