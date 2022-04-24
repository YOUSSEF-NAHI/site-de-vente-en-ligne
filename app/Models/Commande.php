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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prixTotal',
        'user_id',
    ];


    /**
     * The products that belong to the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'Ligne_commandes', 'commande_id', 'produit_id')
                    ->using(LigneCommande::class)
                    ->as('LigneCommande')
                    ->withPivot('prixTotal', 'quantite')
                    ->withTimestamps();
    }

    /**
     * Get the user that owns the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
