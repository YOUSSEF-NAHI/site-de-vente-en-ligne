<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SousCategorie;

class Categorie extends Model
{
    use HasFactory;

    /**
     * Get all of the avis for the Categorie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sousCategories()
    {
        return $this->hasMany(SousCategorie::class, 'categorie_id', 'id');
    }
}
