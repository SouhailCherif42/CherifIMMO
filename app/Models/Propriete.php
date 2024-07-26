<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propriete extends Model
{
    protected $table = 'propriete';
    protected $fillable = [
        'titre',
        'piece',
        'chambre',
        'surface',
        'prix',
        'adresse',
        'Quartier',
        'Ville',
        'Code_Postal',
        'Description',
        'Description_1',
        'Caracteristiques',
        'Achat_Location',
        'img_1',
        'img_2',
        'img_3',
        'img_4',
        'img_5',
        'meuble',
    ];

    public $timestamps = false;

    // Specify the relationship with the Agence model
    public function agence()
    {
        return $this->belongsTo(Agence::class, 'agence_id');
    }

}

