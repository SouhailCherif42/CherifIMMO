<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propriete;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'meuble' => 'nullable|string|max:255',
            'Description' => 'nullable|string',
            'Code_Postal' => 'required|string|max:255',
            'Achat_Location' => 'required|string|max:255',
            'prix' => 'required|integer',
            'surface' => 'required|integer',
            'piece' => 'required|integer',
            'chambre' => 'required|integer',
            'Quartier' => 'required|string|max:255',
            'Ville' => 'required|string|max:255',
            'Description_1' => 'nullable|string',
            'Caracteristiques' => 'nullable|string',
            'agence_id' => 'required|integer',
            'user_id' => 'required|integer',
            'img_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gérer le téléchargement des fichiers d'image
        $images = ['img_1', 'img_2', 'img_3', 'img_4', 'img_5'];
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                $validatedData[$image] = $request->file($image)->store('images', 'public');
            }
        }

        Propriete::create($validatedData);

        return view('new');
    }

    // Méthode pour traiter la recherche
    public function search(Request $request)
    {
        // Créez la requête pour récupérer les propriétés
        $query = Propriete::query();

        if ($request->has('transactionType')) {
            $query->where('Achat_Location', $request->transactionType);
        }

        if ($request->has('location')) {
            $query->where('Ville', 'like', '%' . $request->location . '%');
        }

        if ($request->has('minBudget')) {
            $query->where('prix', '>=', $request->minBudget);
        }

        if ($request->has('maxBudget')) {
            $query->where('prix', '<=', $request->maxBudget);
        }

        $properties = $query->get();

        return view('listing', compact('properties'));
    }

    public function advancedSearch(Request $request)
    {
        $query = Propriete::query();

        if ($request->filled('transactionType')) {
            $query->where('Achat_Location', $request->transactionType);
        }

        if ($request->filled('location')) {
            $query->where('Ville', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('minBudget')) {
            $query->where('prix', '>=', $request->minBudget);
        }

        if ($request->filled('maxBudget')) {
            $query->where('prix', '<=', $request->maxBudget);
        }

        if ($request->filled('piece')) {
            $query->where('piece', '>=', $request->piece);
        }

        if ($request->filled('chambre')) {
            $query->where('chambre', '>=', $request->chambre);
        }

        if ($request->filled('surface')) {
            $query->where('surface', '>=', $request->surface);
        }

        if ($request->filled('Quartier')) {
            $query->where('Quartier', 'like', '%' . $request->Quartier . '%');
        }

        if ($request->filled('Code_Postal')) {
            $query->where('Code_Postal', $request->Code_Postal);
        }

        $properties = $query->get();

        return view('listing', compact('properties'));
    }

    // Méthode pour afficher les propriétés (peut être utilisée pour autre chose)
    public function index()
    {
        // Récupère toutes les propriétés
        $properties = Propriete::all();

        // Si l'utilisateur est authentifié, récupère ses favoris
        $userFavorites = [];
        if (Auth::check()) {
            $userFavorites = Auth::user()->favorites->map(function ($favorite) {
                return $favorite->propriete_id;
            })->toArray();
        }

        // Passe les propriétés et les favoris à la vue
        return view('listing', compact('properties', 'userFavorites'));
    }

    public function show($id)
    {

        $property = Propriete::with('agence')->findOrFail($id);
        return view('house', compact('property'));
    }

    public function edit($id)
    {
        $property = Propriete::findOrFail($id);
        return view('edit', compact('property'));
    }

    // Update the specified property in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'meuble' => 'required|string|max:255',
            'Description' => 'required|string',
            'Code_Postal' => 'required|integer',
            'Achat_Location' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'surface' => 'required|numeric',
        ]);

        $property = Propriete::findOrFail($id);
        $property->update($request->all());

        return view('dashboarduser')->with('success', 'Propriété mise à jour avec succès');
    }

    // Remove the specified property from storage
    public function destroy($id)
    {
        $property = Propriete::findOrFail($id);
        $property->delete();

        return view('welcome')->with('success', 'Propriété mise à jour avec succès');
    }
}
