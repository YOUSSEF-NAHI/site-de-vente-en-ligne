<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Avi;
use App\Models\SousCategorie;

class Produit extends Model
{
    use HasFactory;

    /**
     * Get all of the avis for the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avis()
    {
        return $this->hasMany(Avi::class, 'produit_id', 'id');
    }

    /**
     * Get the sous-categorie associated with the produit.
     */
    public function sousCategorie()
    {
        return $this->hasOne(SousCategorie::class);
    }
}
