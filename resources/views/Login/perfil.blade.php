<x-layout title="Editar Perfil">
    @if(!(count($jogos) <= 0)) <div class="divFavorito">
        @foreach ($jogos as $jogo)

        <!-- Seção de Favoritos -->
        <section class="banner-favoritos text-center mb-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0 fw-bold">Favoritos</h2>
                    <a href="{{ route('favoritos.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-pencil-square"></i> Editar Favoritos
                    </a>
                </div>

                <!-- Card do Jogo -->
                <div class="card game-card p-3 shadow-sm">
                    <!-- Substitua pelo caminho real da sua imagem -->
                    <img src="{{ $jogo->url_imagem }}" class="card-img-top rounded mx-auto d-block mb-2"
                        alt="Capa do Jogo" style="width: 120px; height: 120px; object-fit: cover;">
                    <div class="card-body p-0">
                        <p class="card-text small fw-semibold">{{ $jogo->nome }}</p>
                    </div>
                </div>
            </div>
        </section>

        @endforeach
        </div>
        @endisset
        <form action="{{ route('login.update') }}" method="POST">
            @csrf
            <main class="container mb-5 mt-2">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">

                        <div class="card profile-card shadow">
                            <h3 class="text-center mb-4 fw-bold text-uppercase tracking-wide">Editar Perfil</h3>

                            <div class="mb-3">
                                <label for="inputNome" class="form-label small">Nome</label>
                                <input type="text" class="form-control form-control-lg" id="inputNome" name="name"
                                    value="{{ $usuario->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="inputEmail" class="form-label small">E-mail</label>
                                <input type="email" class="form-control form-control-lg" id="inputEmail" name="email"
                                    value="{{ $usuario->email }}" required>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <label for="idXbox" class="form-label small">ID Xbox</label>
                                    <input type="text" class="form-control form-control-lg" id="idXbox" name="idXbox"
                                        value="{{ $usuario->idXbox }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="idPlaystation" class="form-label small">ID Playstation</label>
                                    <input type="text" class="form-control form-control-lg" id="idPlaystation"
                                        name="idPs" value="{{ $usuario->idPs }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-2">
                                <a class="btn btn-purple" href="{{ route('games.listajogos') }}">Cancelar</a>
                                <button class="btn btn-purple btn-lg" type="button" data-bs-toggle="modal"
                                    data-bs-target="#attPerfil">
                                    <i class="bi bi-check-circle me-2"></i>Salvar Alterações
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </main>

            <div class="modal fade" id="attPerfil" tabindex="-1" aria-labelledby="attPerfilLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title textoModal" id="attPerfilLabel">Confirmação</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="textoModal">Tem certeza que deseja salvar as novas informações?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</x-layout>