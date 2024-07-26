<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $property->titre }}</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/file.ico') }}" type="image/x-icon">
    
    <!-- fonts style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        .custom-carousel {
            max-width: 600px; /* Définissez la largeur maximale souhaitée */
            height: auto; /* Ajuste automatiquement la hauteur pour garder les proportions */
            margin: 0 auto; /* Centre le carrousel horizontalement */
        }

        .custom-carousel img {
            height: 400px; /* Définissez la hauteur maximale souhaitée pour les images */
            object-fit: cover; /* Garde les proportions des images */
        }

        .custom-carousel .carousel-control-prev-icon,
        .custom-carousel .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5); /* Changer la couleur de fond */
            border-radius: 50%; /* Arrondir les boutons */
            padding: 10px; /* Ajouter du padding pour agrandir les boutons */
        }

        .custom-carousel .carousel-control-prev,
        .custom-carousel .carousel-control-next {
            width: 50px; /* Définir la largeur des boutons */
        }
    </style>
</head>

<body class="sub_page">
<div class="hero_area">
    <!-- header section strats -->
    <header>
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="images/AZUR.png" alt="" >
          </a>

          @auth
          @php
          $userRole = session('user_info.role', null);
          $userName = session('user_info.name', 'Invité');
          @endphp

          <div class="nav-item dropdown">
          <a class="nav-link" href="#" id="userDropdown" role="button">
              Bonjour, {{ $userName }} <i class="fas fa-caret-down"></i>
            </a>

            <ul class="dropdown-menu" id="dropdownMenu">
              @if($userRole === 'admin')
              <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Admin Dashboard</a></li>
              <a class="dropdown-item" href="/new">Vendre son Bien</a>
              @elseif($userRole === 'admin_commercial')
              <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Admin Commercial Dashboard</a></li>
              <a class="dropdown-item" href="/new">Vendre son Bien</a>
              @else
              <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Client Dashboard</a></li>
              <a class="dropdown-item" href="/new">Vendre son Bien</a>
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
              <a href="">Qui sommes-nous ?</a>
              <a href="#contactus">Nous Contacter</a>
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
    <!-- end header section -->
  </div>
    <div class="container mt-5">
        <h3 class="property-title text-center">{{ $property->titre }} - {{ $property->meuble }} - ({{ $property->Code_Postal }})</h3>
        <div id="propertyCarousel" class="carousel slide custom-carousel mt-1" data-bs-ride="carousel">
            <div class="carousel-inner">
                @if($property->img_1)
                        <div class="carousel-item active">
                            <img src="{{ asset('images/' . $property->img_1) }}" class="d-block w-100" alt="Image 1">
                        </div>
                    @endif
                    @if($property->img_2)
                        <div class="carousel-item">
                            <img src="{{ asset('images/' . $property->img_2) }}" class="d-block w-100" alt="Image 2">
                        </div>
                    @endif
                    @if($property->img_3)
                        <div class="carousel-item">
                            <img src="{{ asset('images/' . $property->img_3) }}" class="d-block w-100" alt="Image 3">
                        </div>
                    @endif
                    @if($property->img_4)
                        <div class="carousel-item">
                            <img src="{{ asset('images/' . $property->img_4) }}" class="d-block w-100" alt="Image 4">
                        </div>
                    @endif
                    @if($property->img_5)
                        <div class="carousel-item">
                            <img src="{{ asset('images/' . $property->img_5) }}" class="d-block w-100" alt="Image 5">
                        </div>
                    @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <h3>Plus d'informations : {{ $property->titre }} - {{ $property->meuble }}</h3>
                <p>{{ $property->Description }}</p>
                <nav class=" navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#Description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#Caracteristiques">Caracteristiques</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#details">Détails</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#Carte">Carte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#Agence">Agence</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <hr>
                <p><strong>Description :</strong></br> {{ $property->Description_1 }}</p>
                <p><strong>Caracteristiques:</strong></br> {{ $property->Caracteristiques }}</p>
                <p><strong>Prix:</strong></br> {{ $property->prix }} €</p>
                <p><strong>Surface:</strong></br> {{ $property->surface }} m²</p>
                <p><strong>Piece:</strong></br> {{ $property->piece }}</p>
                <p><strong>Chambres:</strong></br> {{ $property->chambre }}</p>
                <p><strong>Adresse :</strong></br> {{$property->adresse }}</p>
                <p><strong>Ville:</strong></br> {{ $property->Ville }}</p>
                <p><strong>Quartier:</strong></br> {{ $property->Quartier }}</p>
                <p><strong>Code Postal:</strong></br> {{ $property->Code_Postal }}</p>
            </div>
            <div class="col-md-4">
                <h4>Détails de l'agence</h4>
                <div class="col-md-10">
                    <div class="mb-3">
                        <p><strong>Agence:</strong> {{ $property->agence->nom }}</p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Adresse:</strong></br> {{ $property->agence->adresse }}</p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Numéro :</strong></br> {{ $property->agence->numero }}</p>
                    </div>
                </div>
                <h4>Contacter l'agence</h4>
                <form class="contact-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" placeholde="Votre Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Votre Email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="3" placeholder="Votre Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

        <div class="map-responsive mt-5">
            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q={{ urlencode($property->adresse) }}" width="250" height="250" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      var userDropdown = document.getElementById('userDropdown');
      var dropdownMenu = document.getElementById('dropdownMenu');

      userDropdown.addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        dropdownMenu.classList.toggle('show'); // Ajoute ou retire la classe 'show'
      });

      // Ferme le menu si on clique en dehors de celui-ci
      document.addEventListener('click', function(event) {
        if (!userDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
          dropdownMenu.classList.remove('show');
        }
      });
    });
  </script>
</body>

</html>
