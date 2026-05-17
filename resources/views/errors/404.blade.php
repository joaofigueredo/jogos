<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <style>
        body{
            background-color: lightgray;
        }
        .titulo{
            text-align: center;
        }
        a{
            text-decoration: none;
        }
        a:hover{
            font-size: 20px;    
        }
    </style>
</head>
<body>
    <h1 class="titulo">A página que você procura não existe!</h1>
    <h3>Realize o login aqui:</h3><a href="{{ route('login.index') }}">login</a>
</body>
</html>