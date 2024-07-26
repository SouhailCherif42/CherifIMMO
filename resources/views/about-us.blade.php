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
  <link rel="icon" href="{{ asset('images/file.ico') }}" type="image/x-icon">

  <title>Teaser</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
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
              <li><a class="dropdown-item" href="{{ url('/admin') }}">Admin Dashboard</a></li>
              @elseif($userRole === 'admin_commercial')
              <li><a class="dropdown-item" href="{{ url('/admin-commercial') }}">Admin Commercial Dashboard</a></li>
              @else
              <li><a class="dropdown-item" href="{{ url('/client') }}">Client Dashboard</a></li>
              @endif
              <li><a class="dropdown-item" href="{{ url('/profile') }}">Mon Profil</a></li>
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
    <!-- end header section -->
  </div>


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
                About Our Apartment
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in
              some form, by injected humour, or randomised words
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->


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


  <!-- footer section -->
  <section class="container-fluid footer_section ">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a>
      </p>
    </div>
  </section>
  <!-- end  footer section -->


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