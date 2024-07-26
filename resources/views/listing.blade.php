<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Teaser</title>


  <!-- bootstrap core css -->
  <link rel="icon" href="{{ asset('images/file.ico') }}" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style1.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <style>
    .search-tag {
      background-color: #3554d1;
      color: white;
      padding: 10px;
      text-align: center;
      font-weight: bold;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .property-card {
      display: flex;
      width: 100%;
      height: 28vh;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
    }

    .property-card .img-box {
      flex: 1;
      max-width: 200px;
    }

    .property-card .img-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .property-card .detail-box {
      flex: 2;
      padding: 15px;
    }

    .property-card .detail-box .header {
      display: flex;
      justify-content: space-between;
    }

    .property-card .detail-box .info {
      margin-top: 10px;
    }

    .property-card .detail-box .info p {
      margin: 5px 0;
    }

    .property-card .detail-box .price {
      flex: 1;
      text-align: right;
      padding: 15px;

    }

    .required::after {
      content: '*';
      color: red;
      font-size: 1rem;
      margin-left: 0.2em;
    }

    .price p {
      margin: 2rem;
      font-weight: 800;
      color: red;
    }

    /* edit.css */
    .btn-favorite {
      background-color: #f0ad4e;
      /* Couleur du bouton */
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      margin: 5px 2px;
      cursor: pointer;
      border-radius: 5px;
    }

    .btn-favorite:hover {
      background-color: #ec971f;
      /* Couleur du bouton au survol */
    }
  </style>
</head>
@auth
@php
$userFavorites = auth()->user()->favorites->pluck('propriete_id')->toArray();
@endphp
@endauth

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header>
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="images/AZUR.png" alt="" style="width:150px">
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
  <!-- advanced search section -->
  <section class="find_section">
    <div class="container">
      <form action="{{ route('advanced-search') }}" method="GET">
        <div class="form-row">
          <!-- Type de transaction -->
          <div class="col-md-12 mb-3">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="transactionType" id="buy" value="Acheter" {{ request('transactionType') == 'Acheter' ? 'checked' : '' }}>
              <label class="form-check-label" for="Acheter">Acheter</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="transactionType" id="rent" value="Louer" {{ request('transactionType') == 'Louer' ? 'checked' : '' }}>
              <label class="form-check-label" for="Louer">Louer</label>
            </div>
          </div>
          <!-- Localisation -->
          <div class="col-md-4 mb-3">
            <label for="location" class="required">Localisation :</label>
            <input type="text" class="form-control" name="location" placeholder="Localisation" value="{{ request('location') }}">
          </div>
          <!-- Budget Min -->
          <div class="col-md-2 mb-3">
            <label for="location" class="required">Bugdet Min :</label>
            <input type="number" class="form-control" name="minBudget" placeholder="Budget Min" value="{{ request('minBudget') }}">
          </div>
          <!-- Budget Max -->
          <div class="col-md-2 mb-3">
            <label for="location" class="required">Budget Max :</label>
            <input type="number" class="form-control" name="maxBudget" placeholder="Budget Max" value="{{ request('maxBudget') }}">
          </div>
          <!-- Pièces -->
          <div class="col-md-2 mb-3">
            <label for="location">Pièces :</label>
            <input type="number" class="form-control" name="piece" min="0" placeholder="Nombre de pièces" value="{{ request('piece') }}">
          </div>
          <!-- Chambres -->
          <div class="col-md-2 mb-3">
            <label for="location">Chambres :</label>
            <input type="number" class="form-control" name="chambre" min="0" placeholder="Nombre de chambres" value="{{ request('chambre') }}">
          </div>
          <!-- Surface -->
          <div class="col-md-2 mb-3">
            <label for="location">Surface Min :</label>
            <input type="number" class="form-control" name="surface" placeholder="Surface minimale" value="{{ request('surface') }}">
          </div>
          <!-- Quartier -->
          <div class="col-md-2 mb-3">
            <label for="location">Quartier :</label>
            <input type="text" class="form-control" name="Quartier" placeholder="Quartier" value="{{ request('Quartier') }}">
          </div>
          <!-- Code Postal -->
          <div class="col-md-2 mb-3">
            <label for="location">Code Postal :</label>
            <input type="text" class="form-control" name="Code_Postal" placeholder="Code Postal" value="{{ request('Code_Postal') }}">
          </div>
          <!-- Bouton de recherche -->
          <div class="col-md-1 mb-3">
            <label style="color:white;">Rechercher</label>
            <button type="submit" class="btn btn-primary">
              <span class="material-symbols-outlined">Rechercher</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- end advanced search section -->


  <!-- sale section -->
  <section class="sale_section layout_padding">
    <div class="container-fluid">
      <div class="heading_container">
        <h2>
          Résultats
        </h2>
        <p>
          Voici les appartements et maisons correspondant à votre recherche.
        </p>
      </div>
      <div class="sale_container">
        @foreach ($properties as $property)
        <div class="container">
          <div class="property-card">
            <div class="img-box">
              <a href="{{ route('house', $property->id) }}">
                <img src="{{ asset('images/' . $property->img_1) }}" alt="{{ $property->titre }}">
              </a>
            </div>
            <div class="detail-box">
              <div class="header">
                <a href="{{ route('house', $property->id) }}">
                  <h6>{{ $property->titre }} - {{ $property->meuble }} - ({{ $property->Code_Postal }})</h6>
                </a>
              </div>
              <div class="info">
                <p>{{ $property->Description }}</p>
                <p><strong>Localisation :</strong> {{ $property->adresse }}</p>
                <p> {{ $property->piece }} Pièces - {{ $property->chambre }} Chambres </p>
                <a href="{{ route('house', $property->id) }}" class="btn btn-primary mt-auto">Voir l'annonce</a>
                <div class="actions">
                  <!-- Add to Favorites Button -->
                  @auth
                  <form action="{{ route('favorites.store') }}" method="POST" class="favorites-form">
                    @csrf
                    <input type="hidden" name="propriete_id" value="{{ $property->id }}">
                    <button type="submit" class="btn btn-favorite">
                      @if (in_array($property->id, $userFavorites))
                      Retirer des Favoris
                      @else
                      Ajouter aux Favoris
                      @endif
                    </button>
                  </form>
                  @endauth
                </div>
              </div>
            </div>
            <div class="price">
              <p>{{ $property->prix }}€</p>
              <p>{{ $property->surface }}m²</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
  </section>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <!-- end sale section -->



  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact">
            <h5>
              About Apartment
            </h5>
            <div>
              <div class="img-box">
                <img src="images/location.png" width="18px" alt="">
              </div>
              <p>
                Address
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="images/phone.png" width="12px" alt="">
              </div>
              <p>
                +01 1234567890
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="images/mail.png" width="18px" alt="">
              </div>
              <p>
                demo@gmail.com
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_info">
            <h5>
              Information
            </h5>
            <p>
              ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
            </p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="info_links">
            <h5>
              Useful Link
            </h5>
            <ul>
              <li>
                <a href="">
                  There are many
                </a>
              </li>
              <li>
                <a href="">
                  variations of
                </a>
              </li>
              <li>
                <a href="">
                  passages of
                </a>
              </li>
              <li>
                <a href="">
                  Lorem Ipsum
                </a>
              </li>
              <li>
                <a href="">
                  available, but
                </a>
              </li>
              <li>
                <a href="">
                  the i
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_form ">
            <h5>
              Newsletter
            </h5>
            <form action="">
              <input type="email" placeholder="Enter your email">
              <button>
                Subscribe
              </button>
            </form>
            <div class="social_box">
              <a href="">
                <img src="images/fb.png" alt="">
              </a>
              <a href="">
                <img src="images/twitter.png" alt="">
              </a>
              <a href="">
                <img src="images/linkedin.png" alt="">
              </a>
              <a href="">
                <img src="images/youtube.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
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
</body>

</html>