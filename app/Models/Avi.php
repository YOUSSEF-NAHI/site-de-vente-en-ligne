<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Avi extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contenu',
        'user_id',
        'produit_id'
    ];

    /**
     * Get the user associated with the avis.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
