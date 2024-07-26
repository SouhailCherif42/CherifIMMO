<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // Spécifiez la table associée au modèle
    protected $table = 'favorites';

    // Définissez les attributs qui peuvent être massivement assignés
    protected $fillable = [
        'user_id',
        'propriete_id',
    ];

    // Optionnel : Si vous ne souhaitez pas utiliser les timestamps (created_at, updated_at)
    public $timestamps = false;

    /**
     * Définit la relation entre le modèle Favorite et le modèle User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Définit la relation entre le modèle Favorite et le modèle Property.
     */
    public function propriete()
    {
        return $this->belongsTo(Propriete::class, 'propriete_id');
    }
}
