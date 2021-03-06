<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Categorie;

class SousCategorie extends Model
{
    use HasFactory;

    /**
     * Get the categorie associated with the sous-categorie.
     */
    public function Categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
