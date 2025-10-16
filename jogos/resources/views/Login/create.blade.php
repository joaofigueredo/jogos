<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/botao-de-login-do-usuario.png') }}">

    <title>Criar conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="login-body">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Criar conta</h2>
                                <p class="text-white-50 mb-5">Por favor coloque seus dados!</p>
                                <form action="{{ route('login.store') }}" method="POST">
                                    @csrf
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="text" id="name" name="name" class="form-control form-control-lg"
                                            autofocus />
                                        <label class="form-label texto-login" for="nome">Nome</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg" />
                                        <label class="form-label texto-login" for="typeEmailX">Email</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                                <input type="text" id="idXbox" name="idXbox"
                                                    class="form-control form-control-lg" />
                                                <label class="form-label texto-login" for="idXbox">ID Xbox</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                                <input type="text" id="idPs" name="idPs"
                                                    class="form-control form-control-lg" />
                                                <label class="form-label texto-login" for="idPs">ID Playstation</label>
                                            </div>
                                        </div>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <input type="password" id="typePasswordX" name="password"
                                    class="form-control form-control-lg" />
                                <label class="form-label texto-login" for="typePasswordX">Senha</label>
                            </div>

                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5"
                                type="submit">Criar usuário</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</body>

</html>