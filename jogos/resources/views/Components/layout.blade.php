<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="{{ asset('images/controle-de-video-game.png') }}">
</head>

<body class="body">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            @if (Auth::check())
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home.jogos') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('buscar.games') }}">Jogos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('busca.similares') }}">Similares</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                    <form method="POST" action="{{ route('login.logout') }}">
                    @csrf
                        <li class="nav-item">
                            <button class="nav-link">Logout</button>
                        </li>
                    </form>
            @endif
                @if(!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.index') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>


    @if ($errors->any())
        <div class="alert alert-danger" id="mensagem">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <script>
        setTimeout(function () {
            document.getElementById('mensagem').style.display = 'none';
        }, 5000);
    </script>

    {{ $slot }}
</body>

</html>