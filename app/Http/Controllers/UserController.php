<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Propriete;

class UserController extends Controller
{
    /**
     * Affiche le formulaire de connexion / inscription.
     *
     * @return \Illuminate\View\View
     */
    public function showAuthForm()
    {
        return view('auth'); // Vue avec les cartes de connexion et d'inscription
    }
    public function showDashboard()
    {
        $userRole = session('user_info.role', null);
        $userName = session('user_info.name', 'Invité');
        $properties = [];
        $userFavorites = [];

        if (auth()->check()) {
            $userFavorites = auth()->user()->favorites()->pluck('propriete_id')->toArray();
            $favoriteProperties = Propriete::whereIn('id', $userFavorites)->get();
        } else {
            $favoriteProperties = collect();
        }

        if ($userRole === 'admin') {
            $properties = Propriete::all();
        } elseif ($userRole === 'admin_commercial') {
            $userId = Auth::id();
            $properties = Propriete::where('user_id', $userId)->get();
        }

        return view('dashboarduser', compact('userRole', 'userName', 'properties', 'favoriteProperties'));
    }


    /**
     * Gère une demande de connexion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // Stocker des informations supplémentaires dans la session
            $user = Auth::user();
            $request->session()->put('user_info', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]);

            return redirect()->intended('/logged');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ]);
    }

    /**
     * Gère une demande d'inscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/auth');
    }

    /**
     * Déconnecte l'utilisateur.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Récupérer l'utilisateur connecté
        $user = Auth::user(); // Utilisation d'Auth::user() pour obtenir l'utilisateur actuellement authentifié

        // Vérifier le mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mettre à jour l'email
        $user->email = $request->email;

        // Mettre à jour le mot de passe s'il est fourni
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        $user->update([
            'email' => $request->email,
            'password' => $request->new_password ? Hash::make($request->new_password) : $user->password,
        ]);

        return back()->with('status', 'Profil mis à jour avec succès!');
    }
}
