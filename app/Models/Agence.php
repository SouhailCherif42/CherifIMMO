<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'agence';

    // Define the primary key for the table
    protected $primaryKey = 'id';

    // Specify which attributes should be mass assignable
    protected $fillable = [
        'nom',
        'adresse',
        'numero'
    ];

}
