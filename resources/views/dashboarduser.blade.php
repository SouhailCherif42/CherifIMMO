<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"> <!-- Lien vers le fichier CSS -->
    <link rel="icon" href="{{ asset('images/file.ico') }}" type="image/x-icon">
    <style>
        .property-list,
        .property-item {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .property-card,
        .property-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 1150px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 20px;
        }

        .img-box img {
            width: 300px;

            height: auto;
            border-radius: 8px;
        }

        .detail-box,
        .property-details {
            display: flex;
            flex-direction: column;
            /* Allow the details box to take up remaining space */
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
            font-size: 1.2em;
        }

        .info p,
        .price p {
            margin: 5px 0;
        }

        .actions {
            margin-top: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            /* Ensure buttons are displayed as block */
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            color: #fff;
            text-align: center;
            text-decoration: none;
            background-color: #007bff;
            font-size: 0.9em;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn:focus {
            outline: none;
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

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    @php
    $userRole = session('user_info.role', null);
    $userName = session('user_info.name', 'Invité');
    @endphp
    <header class="header">
        <nav class="navbar">
            <a href="#" class="navbar-brand">Dashboard @if ($userRole === 'admin') Admin @elseif ($userRole === 'admin_commercial') Admin Commercial @elseif ($userRole === 'Client')Client
                @endif - {{$userName}}</a>
            <ul class="navbar-menu">
                <li><a href="/listing">Retour au recherches</a></li>
                <li><a href="/">Accueil</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="#Proprietes">Proprietes</a></li>
                <li><a href="#Favoris">Favoris</a></li>
                <li><a href="#Profil">Profil</a></li>
            </ul>
        </aside>

        <main class="main-content">
            @if ($userRole === 'admin')
            <section id="Proprietes" class="card">
                <h2>Proprietes</h2>
                @if (count($properties) > 0)
                <div class="property-list">
                    @foreach ($properties as $property)
                    <div class="property-card">
                        <div class="img-box">
                            <a href="{{ route('house', $property->id) }}">
                                <img src="{{ asset('images/' . $property->img_1) }}" alt="{{ $property->titre }}">
                            </a>
                        </div>
                        <div class="detail-box">
                            <div class="header">
                                <a href="{{ route('house', $property->id) }}">
                                    <h3>{{ $property->titre }} - {{ $property->meuble }} - ({{ $property->Code_Postal }})</h3>
                                </a>
                            </div>
                            <div class="info">
                                <p>{{ $property->Description }}</p>
                                <p><strong>Localisation :</strong> {{ $property->adresse }}</p>
                                <p><strong>Transaction : </strong> {{ $property->Achat_Location }}</p>
                            </div>
                        </div>
                        <div class="price">
                            <p> {{ $property->prix }}€</p>
                            <p> {{ $property->surface }}m²</p>
                        </div>
                        <div class="actions">
                            <a href="{{ route('property.edit', $property->id) }}" class="btn btn-edit">Modifier</a>
                            <form action="{{ route('property.destroy', $property->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>

                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p>Aucune propriété disponible.</p>
                @endif
            </section>
            @elseif ($userRole === 'admin_commercial')
            <section id="Proprietes" class="card">
                <h2>Proprietes</h2>
                <p>Vos Proprietes.</p>
                @if (count($properties) > 0)
                <div class="property-list">
                    @foreach ($properties as $property)
                    <div class="property-list">
                        @foreach ($properties as $property)
                        <div class="property-card">
                            <div class="img-box">
                                <a href="{{ route('house', $property->id) }}">
                                    <img src="{{ asset('images/' . $property->img_1) }}" alt="{{ $property->titre }}">
                                </a>
                            </div>
                            <div class="detail-box">
                                <div class="header">
                                    <a href="{{ route('house', $property->id) }}">
                                        <h3>{{ $property->titre }} - {{ $property->meuble }} - ({{ $property->Code_Postal }})</h3>
                                    </a>
                                </div>
                                <div class="info">
                                    <p>{{ $property->Description }}</p>
                                    <p><strong>Localisation :</strong> {{ $property->adresse }}</p>
                                    <p><strong>Transaction : </strong> {{ $property->Achat_Location }}</p>
                                </div>
                            </div>
                            <div class="price">
                                <p> {{ $property->prix }}€</p>
                                <p> {{ $property->surface }}m²</p>
                            </div>
                            <div class="actions">
                                <a href="{{ route('property.edit', $property->id) }}" class="btn btn-edit">Modifier</a>
                                <form action="{{ route('property.destroy', $property->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>

                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @else
                <p>Aucune propriété disponible.</p>
                @endif
            </section>
            @endif

            <section id="Favoris" class="card">
                <h2>Favoris</h2>
                <p>Vos Favoris.</p>
                @if($favoriteProperties->isEmpty())
                <p>Vous n'avez aucun favori pour le moment.</p>
                @else
                <div class="row">
                    @foreach ($favoriteProperties as $property)
                    <div class="col-md-4">
                        <div class="property-card">
                            <div class="img-box">
                                <a href="{{ route('house', $property->id) }}">
                                    <img src="{{ asset('images/' . $property->img_1) }}" alt="{{ $property->titre }}">
                                </a>
                            </div>
                            <div class="detail-box">
                                <div class="header">
                                    <a href="{{ route('house', $property->id) }}">
                                        <h3>{{ $property->titre }} - {{ $property->meuble }} - ({{ $property->Code_Postal }})</h3>
                                    </a>
                                </div>
                                <div class="info">
                                    <p>{{ $property->Description }}</p>
                                    <p><strong>Localisation :</strong> {{ $property->adresse }}</p>
                                    <a href="{{ route('house', $property->id) }}" class="btn btn-primary mt-auto">Voir l'annonce</a>
                                    <form action="{{ route('favorites.destroy', $property->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-family:'Poppins', sans-serif;">Retirer de ses favoris</button>
                                    </form>
                                </div>
                            </div>
                            <div class="price">
                                <p> {{ $property->prix }}€</p>
                                <p> {{ $property->surface }}m²</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
                @endif
            </section>

            <section id="Profil" class="card">
                <h2>Profil</h2>
                <p>Bienvenue sur votre profil ! Ici vous pouvez modifier vos informations.</p>
                <!-- Formulaire de changement d'email et de mot de passe -->
                <form action="{{ route('updateProfile') }}" method="POST" class="profile-form">
                    @csrf
                    <div class="form-group">
                        <label for="email">Nouvel Email</label>
                        <input type="email" id="email" name="email" required placeholder="Votre nouvel email">
                    </div>

                    <div class="form-group">
                        <label for="current-password">Mot de Passe Actuel</label>
                        <input type="password" id="current-password" name="current_password" required placeholder="Mot de passe actuel">
                    </div>

                    <div class="form-group">
                        <label for="new-password">Nouveau Mot de Passe</label>
                        <input type="password" id="new-password" name="new_password" required placeholder="Nouveau mot de passe">
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirmer le Mot de Passe</label>
                        <input type="password" id="confirm-password" name="confirm_password" required placeholder="Confirmer le mot de passe">
                    </div>

                    <button type="submit" class="btn">Mettre à jour</button>
                </form>
            </section>
        </main>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Cherif Corp. All rights reserved.</p>
    </footer>
</body>

</html>