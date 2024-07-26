<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoritesController;

Route::get('/', function () {
    
    return view('welcome');
});

Route::get('/new', function () {
    
    return view('new');
});

Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('dashboard');

Route::get('/logged', function () {
    $userInfo = session('user_info');
    return view('welcome', ['userInfo' => $userInfo]);
});


// Route pour la recherche
Route::get('/search', [PropertyController::class, 'search'])->name('search');

// Route pour afficher les résultats de la recherche
Route::get('/listing', [PropertyController::class, 'index'])->name('listing');

// Route pour afficher les résultats de la recherche avancée
Route::get('/advanced-search', [PropertyController::class, 'advancedSearch'])->name('advanced-search');

//Route pour afficher une annonce
Route::get('/property/{id}', [PropertyController::class, 'show'])->name('house');

Route::get('/auth', [UserController::class, 'showAuthForm'])->name('auth');

// Routes pour le login et l'inscription
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Route pour la déconnexion
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('updateProfile');

// Route to show the edit form
Route::get('/property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');

// Route to update the property
Route::put('/property/{id}', [PropertyController::class, 'update'])->name('property.update');

// Route to delete the property
Route::delete('/property/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');

Route::post('/favorites', [FavoritesController::class, 'store'])->name('favorites.store');

Route::delete('/favorites/{propriete_id}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');

// Route pour afficher le formulaire de création (GET)
Route::get('/properties/create', [PropertyController::class, 'create'])->name('property.create');

// Route pour gérer le POST du formulaire de création (POST)
Route::post('/properties', [PropertyController::class, 'store'])->name('property.store');

