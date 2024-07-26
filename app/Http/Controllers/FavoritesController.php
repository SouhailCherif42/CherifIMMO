<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    // Ajouter aux Favoris
    public function store(Request $request)
    {
        $userId = Auth::id();
        $propertyId = $request->input('propriete_id');

        // Vérifiez si la propriété est déjà dans les favoris
        $existingFavorite = Favorite::where('user_id', $userId)
            ->where('propriete_id', $propertyId)
            ->first();

        if (!$existingFavorite) {
            Favorite::create([
                'user_id' => $userId,
                'propriete_id' => $propertyId
            ]);
        }

        // Rediriger vers le dashboard avec un message de succès
        return redirect()->route('listing')->with('success', 'Propriété ajoutée aux favoris.');
    }


    // Retirer des Favorispublic function destroy($propriete_id)
    public function destroy($propriete_id)
    {
        $userId = Auth::id();
        Favorite::where('user_id', $userId)
            ->where('propriete_id', $propriete_id)
            ->delete();

        // Rediriger vers le dashboard avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Propriété retirée des favoris.');
    }
}
