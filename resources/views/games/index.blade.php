<x-layout title="Jogos">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div class="d-flex align-items-center gap-2">
            <h2 class="fw-bold text-dark m-0">Jogos</h2>
        </div>
        <a href="{{ route('buscar.games') }}"
            class="btn btn-success d-flex align-items-center gap-2 px-3 py-2 fw-semibold rounded-3 shadow-sm">
            <i class="bi bi-box-arrow-left"></i> Voltar
            </a>
    </div>
    <div class="container mt-2">
        <div class="row">
            @foreach ($jogos as $jogo)
            <div class="col">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden game-card bg-white">
                        <img src="https:{{$jogo['cover']['url']}}" class="card-img-top game-cover" alt="">

                        <div class="card-body d-flex flex-column justify-content-between p-3">
                            <h5 class="card-title fw-bold text-dark text-truncate mb-3">{{$jogo['name']}}</h5>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i></span>

                                <button class="btn btn-outline-danger btn-sm border-0 rounded-circle p-2" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addJogo">
                                    <i class="bi bi-plus-circle-fill fs-6"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="botaoAdd" action="{{ route('adicionar') }}" method="POST">
                @csrf
                <input type="hidden" name="id_jogo" value="{{ $jogo['id'] }}">
                <input type="hidden" name="nome" value="{{ $jogo['name'] }}">
                <input type="hidden" name="cover" value="{{ $jogo['cover']['url'] }}">
                <input type="hidden" name="idJogador" value="{{ auth()->user()->id }}">

                <!-- modal -->
                <div class="modal fade" id="addJogo" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmação</h5>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja adicionar {{ $jogo['name'] }} na biblioteca?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primary" type="submit">Adicionar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>