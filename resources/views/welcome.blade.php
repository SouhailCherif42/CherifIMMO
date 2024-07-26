<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CHERIF CORP</title>

  <!-- Stylesheets -->
  <link rel="icon" href="{{ asset('images/file.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}?v={{ time() }}" rel="stylesheet">
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
  <style>
    *{
      font-family: 'Poppins', sans-serif;
    }
    .row2{
      justify-content: center;
    }
    .required::after {
      content: '*';
      color: red;
      font-size: 1rem;
      margin-left: 0.2em;
    }

    /* Styles de base pour le menu déroulant */
    .nav-item {
      position: relative;
      /* Positionne le parent relativement pour que le menu soit positionné par rapport à lui */
    }

    .dropdown-menu {
      display: none;
      /* Masquer le menu par défaut */
      position: absolute;
      /* Positionner le menu en absolu */
      top: 100%;
      /* Placez le menu juste en dessous du bouton */
      left: 0;
      background-color: #ffffff;
      /* Fond blanc pour le menu */
      border: 1px solid #ddd;
      /* Bordure légère */
      border-radius: 0.25rem;
      /* Coins arrondis */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      /* Ombre légère pour la visibilité */
      z-index: 1000;
      /* Assurez-vous que le menu est au-dessus des autres éléments */
    }

    .dropdown-menu.show {
      display: block;
      /* Affichez le menu lorsque la classe 'show' est ajoutée */
    }

    /* Optionnel: Styles pour les éléments du menu */
    .dropdown-item {
      padding: 0.5rem 1rem;
      color: #333;
      text-decoration: none;
      display: block;
    }

    .dropdown-item:hover {
      background-color: #f8f9fa;
      /* Changement de couleur au survol */
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <header>
      <div class="container-fluid">
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
              <a href="/listing">Rechercher</a>
              <a href="#contactus">Contact</a>
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


    <section class="slider_section ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 offset-md-1">
            <div class="detail-box">
              <h1>
                Agence Immobilière<br>
                <span> CHERIF</span>
              </h1>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque aliquam lorem orci, in mattis odio suscipit sit amet. Vestibulum id tortor pellentesque, imperdiet leo vitae, bibendum orci.
              </p>
              <div class="btn-box">
                <a href="" class="">
                  En savoir plus
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- search section -->
  <section class="find_section">
    <div class="container">
      <form action="{{ route('search') }}" method="GET">
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
          <div class="col-md-5 mb-3">
            <label for="" class="required">Ville :</label>
            <input type="text" class="form-control" name="location" placeholder="Localisation" value="{{ request('location') }}">
          </div>
          <!-- Budget Min -->
          <div class="col-md-3 mb-3">
            <label for="" class="required">Budget Min :</label>
            <input type="number" class="form-control" name="minBudget" placeholder="Budget Min" value="{{ request('minBudget') }}">
          </div>
          <!-- Budget Max -->
          <div class="col-md-3 mb-3">
            <label for="" class="required">Budget Max :</label>
            <input type="number" class="form-control" name="maxBudget" placeholder="Budget Max" value="{{ request('maxBudget') }}">
          </div>
          <!-- Bouton de recherche -->
          <div class="col-md-1 mb-3">
            <label style="color:white;" for="">search</label>
            <button type="submit" class="btn btn-primary">
              <span class="material-symbols-outlined">search</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- end search section -->


  <!-- about section -->

  <section class="about_section layout_padding-bottom">
    <div class="square-box">
      <img src="images/square.png" alt="">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/about-img.jpg" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                A propos de nos appartements
              </h2>
            </div>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque aliquam lorem orci, in mattis odio suscipit sit amet. Vestibulum id tortor pellentesque, imperdiet leo vitae, bibendum orci.
            </p>
            <a href="">
              En savoir plus
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- us section -->
  <section class="us_section layout_padding2">

    <div class="container">
      <div class="heading_container">
        <h2>
          Pourquoi nous sommes les meilleurs ?
        </h2>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <div class="box">
            <div class="img-box">
              <img src="images/u-1.png" alt="">
            </div>
            <div class="detail-box">
              <h3 class="price">
                1000+
              </h3>
              <h5>
                Années d'habitation
              </h5>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="box">
            <div class="img-box">
              <img src="images/u-2.png" alt="">
            </div>
            <div class="detail-box">
              <h3>
                20000+
              </h3>
              <h5>
                Projets réalisés
              </h5>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="box">
            <div class="img-box">
              <img src="images/u-3.png" alt="">
            </div>
            <div class="detail-box">
              <h3>
                10000+
              </h3>
              <h5>
                Clients satisfaits
              </h5>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="box">
            <div class="img-box">
              <img src="images/u-4.png" alt="">
            </div>
            <div class="detail-box">
              <h3>
                1500+
              </h3>
              <h5>
                Tarifs bon marché
              </h5>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-box">
        <a href="">
          Obtenir un devis
        </a>
      </div>
    </div>
  </section>

  <!-- end us section -->

  <!-- client secction -->

  <section class="client_section layout_padding">
    <div class="container-fluid">
      <div class="heading_container">
        <h2>
          Ce que dit notre clientèle
        </h2>
      </div>
      <div class="client_container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="box">
                <div class="img-box">
                  <img src="images/client.jpg" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    <span>Gourcuff</span>
                    <hr>
                  </h5>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque aliquam lorem orci, in mattis odio suscipit sit amet. Vestibulum id tortor pellentesque, imperdiet leo vitae,
                    bibendum orci. Morbi bibendum pretium erat, eget ullamcorper mi malesuada ut.
                  </p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="box">
                <div class="img-box">
                  <img src="images/client.jpg" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    <span>Cristiano</span>
                    <hr>
                  </h5>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque aliquam lorem orci, in mattis odio suscipit sit amet. Vestibulum id tortor pellentesque, imperdiet leo vitae, bibendum orci. Morbi bibendum pretium erat, eget ullamcorper mi malesuada ut.
                  </p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="box">
                <div class="img-box">

                </div>
                <div class="detail-box">
                  <h5>
                    <span>Lionel</span>
                    <hr>
                  </h5>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque aliquam lorem orci, in mattis odio suscipit sit amet. Vestibulum id tortor pellentesque, imperdiet leo vitae, bibendum orci. Morbi bibendum pretium erat, eget ullamcorper mi malesuada ut.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="" role="button" data-slide="next">
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- end client section -->

  <!-- contact section -->

  <section class="contact_section " id="contactus">
    <div class="container">
      <div class="heading_container">
        <h2>
          Nous contacter ?
        </h2>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row row2">
        <div class="col-md-6 px-0">
          <div class="map_container">
            <div class="map-responsive">
              <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Statue+of+Liberty+New+York+USA" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-5 ">
          <div class="form_container">
            <form action="">
              <div>
                <input type="text" placeholder="Name" />
              </div>
              <div>
                <input type="email" placeholder="Email" />
              </div>
              <div>
                <input type="text" placeholder="Phone Number" />
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" />
              </div>
              <div class="d-flex ">
                <button>
                  Envoyer
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- end contact section -->



  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact">
            <h5>
              A propos
            </h5>
            <div>
              <div class="img-box">
                <img src="images/location.png" width="18px" alt="">
              </div>
              <p>
                Addresse
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="images/phone.png" width="12px" alt="">
              </div>
              <p>
                +06 66 66 66 66
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="images/mail.png" width="18px" alt="">
              </div>
              <p>
                immolaravel@gmail.com
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
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="info_links">
            <h5>
              Liens Utiles
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
                S'abonner
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

  <script type="text/javascript" src="assets('js/jquery-3.4.1.min.js')"></script>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap Bundle with Popper (JavaScript) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


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

</html>