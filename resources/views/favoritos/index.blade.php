<x-layout title="Gerenciar Favoritos">
    @isset($jogos)
    <main class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div class="d-flex align-items-center gap-2">
                <h2 class="fw-bold text-dark m-0">Meus Favoritos</h2>
                <span class="badge bg-success rounded-pill fs-6">{{ count($jogos) }}
                    {{ count($jogos) == 1 ? 'Jogo' : 'Jogos' }}</span>
            </div>
            @if(count($jogos) < 4) <a href="{{ route('games.listajogos') }}"
                class="btn btn-success d-flex align-items-center gap-2 px-3 py-2 fw-semibold rounded-3 shadow-sm">
                <i class="bi bi-plus-lg"></i> Adicionar Favorito
                </a>
                @endif
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ( $jogos as $jogo)

            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden game-card bg-white">
                    <img src="{{ $jogo->url_imagem }}" class="card-img-top game-cover" alt="{{ $jogo->nome }}">

                    <div class="card-body d-flex flex-column justify-content-between p-3">
                        <h5 class="card-title fw-bold text-dark text-truncate mb-3">{{ $jogo->nome }}</h5>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i> Favoritado</span>

                            <button class="btn btn-outline-danger btn-sm border-0 rounded-circle p-2" type="button"
                                data-bs-toggle="modal" data-bs-target="#attFavorito{{$jogo->id}}">
                                <i class="bi bi-trash3-fill fs-6"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('favoritos.destroy', ['id' => $jogo->id]) }}" method="POST">
                @csrf
                <div class="modal fade" id="attFavorito{{$jogo->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold">Confirmação</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p class="m-0 text-secondary">Tem certeza que deseja remover o jogo
                                    <strong>{{ $jogo->nome }}</strong> dos seus favoritos?
                                </p>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-light rounded-3 fw-semibold"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-danger rounded-3 fw-bold" type="submit">Remover</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @endforeach
            @if(count($jogos) < 4) <div class="col">
                <a href="{{ route('games.listajogos') }}"
                    class="card h-100 rounded-4 add-card d-flex flex-column justify-content-center align-items-center text-decoration-none text-secondary p-4">
                    <i class="bi bi-plus-circle-dotted mb-2" style="font-size: 3rem;"></i>
                    <span class="fw-bold">Adicionar Novo</span>
                </a>
        </div>
        @endif

        </div>
    </main>
    @else

    @endisset


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>