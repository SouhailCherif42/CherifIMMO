<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/file.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <title>Modifier</title>
    <style>
    </style>
</head>
<body>
<header>
      <div class="container-fluid" style="background-color:#0056b3;">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="images/AZURBLEU.png" alt="" style="width:150px">
          </a>

          @auth
          @php
          $userRole = session('user_info.role', null);
          $userName = session('user_info.name', 'Invité');
          @endphp

          <div class="nav-item dropdown">
          <a class="nav-link" href="#" id="userDropdown" role="button" style="color:white;">
              Bonjour, {{ $userName }} <i class="fas fa-caret-down"></i>
            </a>

            <ul class="dropdown-menu" id="dropdownMenu">
              @if($userRole === 'admin')
              <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Admin Dashboard</a></li>
              @elseif($userRole === 'admin_commercial')
              <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Admin Commercial Dashboard</a></li>
              @else
              <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Client Dashboard</a></li>
              @endif
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item">Déconnexion</button>
                </form>
              </li>
            </ul>
          </div>

          @else
          <div class="nav-item">
            <a class="nav-link" href="{{ url('/auth') }}">Se Connecter</a>
          </div>
          <div class="nav-item">
            <a class="nav-link" href="{{ url('/auth') }}">S'inscrire</a>
          </div>
          @endauth

          <div class="custom_menu-btn">
            <button onclick="openNav()">
              <span class="s-1"></span>
              <span class="s-2"></span>
              <span class="s-3"></span>
            </button>
          </div>

          <div id="myNav" class="overlay">
            <div class="overlay-content">
              <a href="{{ url('/') }}">Accueil</a>
              <a href="{{ url('/about') }}">Qui sommes-nous ?</a>
              <a href="{{ url('/contact') }}">Nous Contacter</a>
              @auth
              @if($userRole === 'admin')
              <a href="{{ url('/admin') }}">Admin Dashboard</a>
              @elseif($userRole === 'admin_commercial')
              <a href="{{ url('/admin-commercial') }}">Admin Commercial Dashboard</a>
              @else
              <a href="{{ url('/client') }}">Client Dashboard</a>
              @endif
              <a href="{{ url('/profile') }}">Mon Profil</a>
              @else
              <a href="{{ url('/auth') }}">Se Connecter</a>
              <a href="{{ url('/auth') }}">S'inscrire</a>
              @endauth
            </div>
          </div>
        </nav>
      </div>
    </header>
<div class="container">
    <h2>Modifier la Propriété n°{{$property->id}}</h2>
    <form action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="titre">Titre de l'annonce </label>
            <input type="text" id="titre" name="titre" value="{{ $property->titre }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ $property->adresse }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="meuble">Meublé ( Meublé / Non Meublé )</label>
            <input type="text" id="meuble" name="meuble" value="{{ $property->meuble }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="Description">Description</label>
            <textarea id="Description" name="Description" class="form-control">{{ $property->Description }}</textarea>
        </div>

        <div class="form-group">
            <label for="Code_Postal">Code Postal</label>
            <input type="text" id="Code_Postal" name="Code_Postal" value="{{ $property->Code_Postal }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="Achat_Location">Transaction ( Acheter / Louer )</label>
            <input type="text" id="Achat_Location" name="Achat_Location" value="{{ $property->Achat_Location }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="prix">Prix (€)</label>
            <input type="number" id="prix" name="prix" value="{{ $property->prix }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="surface">Surface (m²)</label>
            <input type="number" id="surface" name="surface" value="{{ $property->surface }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="piece">Nombre de Pièces</label>
            <input type="number" id="piece" name="piece" value="{{ $property->piece }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="chambre">Nombre de Chambres</label>
            <input type="number" id="chambre" name="chambre" value="{{ $property->chambre }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="Quartier">Quartier</label>
            <input type="text" id="Quartier" name="Quartier" value="{{ $property->Quartier }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="Ville">Ville</label>
            <input type="text" id="Ville" name="Ville" value="{{ $property->Ville }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="Description_1">Description Supplémentaire</label>
            <input type="text" id="Description_1" name="Description_1" value="{{ $property->Description_1 }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="Caracteristiques">Caractéristiques</label>
            <input type="text" id="Caracteristiques" name="Caracteristiques" value="{{ $property->Caracteristiques }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="img_1">Image 1</label>
            <input type="file" id="img_1" name="img_1" class="form-control">
            @if($property->img_1)
                <img src="{{ asset('images/' . $property->img_1) }}" alt="Image 1" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="img_2">Image 2</label>
            <input type="file" id="img_2" name="img_2" class="form-control">
            @if($property->img_2)
                <img src="{{ asset('images/' . $property->img_2) }}" alt="Image 2" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="img_3">Image 3</label>
            <input type="file" id="img_3" name="img_3" class="form-control">
            @if($property->img_3)
                <img src="{{ asset('images/' . $property->img_3) }}" alt="Image 3" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="img_4">Image 4</label>
            <input type="file" id="img_4" name="img_4" class="form-control">
            @if($property->img_4)
                <img src="{{ asset('images/' . $property->img_4) }}" alt="Image 4" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="img_5">Image 5</label>
            <input type="file" id="img_5" name="img_5" class="form-control">
            @if($property->img_5)
                <img src="{{ asset('images/' . $property->img_5) }}" alt="Image 5" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</body>
</html>
