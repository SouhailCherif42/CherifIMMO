<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion / Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/file.ico') }}" type="image/x-icon">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .auth-container {
            max-width: 800px;
            width: 100%;
            margin: auto;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .auth-content {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .auth-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .auth-card {
            display: none;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .auth-card.active {
            display: block;
        }

        .nav-link {
            cursor: pointer;
            margin: 0 10px;
        }

        .nav-link.active {
            font-weight: bold;
            color: #007bff;
        }

        .auth-footer {
            margin-top: 20px;
            text-align: center;
        }

        .auth-footer a {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-content">
            <div class="col-md-8">
                <div class="auth-header">
                    <h1>Connexion / Inscription</h1>
                    <p class="lead">Veuillez choisir l'option souhaitée pour vous connecter ou vous inscrire.</p>
                    <div class="nav text-center">
                        <span class="nav-link active" id="login-toggle">Connexion</span>
                        <span class="nav-link" id="signup-toggle">Inscription</span>
                    </div>
                </div>
                <div class="row">
                    <!-- Connexion Card -->
                    <div id="login-card" class="col-md-12 auth-card active">
                        <h2>Connexion</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Adresse e-mail</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="loginEmail" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword" name="password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </div>
                        </form>

                        <div class="auth-footer mt-3">
                            <p><a href="#">Mot de passe oublié ?</a></p>
                        </div>
                    </div>

                    <!-- Inscription Card -->
                    <div id="signup-card" class="col-md-12 auth-card">
                        <h2>Inscription</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="registerName" class="form-label">Nom complet</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="registerName" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label">Adresse e-mail</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="registerEmail" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="registerPassword" name="password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="registerPasswordConfirm" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" id="registerPasswordConfirm" name="password_confirmation" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                            </div>
                        </form>

                        <div class="auth-footer mt-3">
                            <p>Déjà un compte ? <span id="login-toggle-link">Se connecter</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('login-toggle').addEventListener('click', function() {
            document.getElementById('login-card').classList.add('active');
            document.getElementById('signup-card').classList.remove('active');
            this.classList.add('active');
            document.getElementById('signup-toggle').classList.remove('active');
        });

        document.getElementById('signup-toggle').addEventListener('click', function() {
            document.getElementById('signup-card').classList.add('active');
            document.getElementById('login-card').classList.remove('active');
            this.classList.add('active');
            document.getElementById('login-toggle').classList.remove('active');
        });

        document.getElementById('login-toggle-link').addEventListener('click', function() {
            document.getElementById('signup-card').classList.remove('active');
            document.getElementById('login-card').classList.add('active');
            document.getElementById('login-toggle').classList.add('active');
            document.getElementById('signup-toggle').classList.remove('active');
        });
    </script>
</body>

</html>