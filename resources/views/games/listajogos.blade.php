<x-layout title="Seus jogos">

    <div class="list-group gap-2">
        @foreach ($jogos as $jogo)

        <div
            class="list-group-item list-group-item-action d-flex flex-column flex-md-row justify-content-between align-items-md-center p-3 border-0 shadow-sm rounded-4 bg-white">

            <div class="d-flex align-items-center gap-3">
                <div class="bg-light p-3 rounded-3 text-success">
                    <img src="{{ $jogo->url_imagem }}" alt="imagem do jogo">
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-0 fs-5">{{ $jogo->nome }}</h6>
                    @if($jogo->finalizado == 1)
                    <span class="badge bg-light text-secondary border mt-1">finalizado</span>
                    @else
                    <span class="badge bg-light text-secondary border mt-1">biblioteca</span>
                    @endif
                </div>
            </div>

            <div class="d-flex align-items-center gap-2 mt-3 mt-md-0 justify-content-end">
                <form action="{{ route('busca.similares') }}" method="POST">
                    @csrf
                    <input type="hidden" name="nome" value="{{ $jogo->nome }}">
                    <button class="btn btn-warning btn-sm text-white px-3 rounded-3" title="Dica" type="submit">
                        <i class="bi bi-lightbulb-fill"></i> <span class="d-none d-lg-inline ms-1">Dica</span>
                    </button>
                </form>

                <button class="btn btn-outline-success btn-sm px-3 rounded-3" title="Favoritar" data-bs-toggle="modal"
                    data-bs-target="#{{ in_array($jogo->id, $favoritos) ? 'attFavorito' : 'addFavorito' }}{{ $jogo->id }}">
                    <i class="bi bi-heart-fill"></i>
                </button>
                @if($jogo->finalizado == false)
                <button class="btn btn-outline-success btn-sm px-3 rounded-3" title="" title="Excluir"
                    data-bs-toggle="modal" data-bs-target="#addFinalizado{{ $jogo->id }}" type="button">
                    <i class="bi bi-plus-circle-fill"></i>
                </button>
                @else

                @endif
                <a href=" {{ route('games.show', ['id' => $jogo->id]) }}"
                    class="btn btn-success btn-sm px-3 rounded-3 fw-semibold">
                    Detalhes
                </a>

                <div class="vr mx-1 d-none d-md-block" style="height: 25px;"></div>

                <button class="btn btn-outline-danger btn-sm border-0 rounded-circle p-2" title="Excluir"
                    data-bs-toggle="modal" data-bs-target="#apagarJogo{{ $jogo->id }}" type="button">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </div>

        </div>

        <!-- modal -->
        <div class="modal fade" id="addFinalizado{{ $jogo->id }}" tabindex="-1">
            <form class="botaoAdd" action="{{ route('games.finalizar') }}" method="POST">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmação</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="{{ $jogo->id }}" id="idJogo" name="idJogo">
                            <p>Adicionar jogo aos zerados?</p>
                            <textarea type="text" id="critica" name="critica" class="form-control form-control-lg"
                                placeholder="Critica"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Adicionar</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>


        @if(in_array($jogo->id, $favoritos))
        <div class="modal fade" id="attFavorito{{ $jogo->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja remover o favorito?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('favoritos.destroy', ['id' => $jogo->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="modal fade" id="addFavorito{{ $jogo->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja adicionar {{ $jogo->nome }} aos favoritos?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('games.favorito', ['id_jogo' => $jogo->id])}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary botaoSalvarJogo">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="modal fade" id="apagarJogo{{ $jogo->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir {{ $jogo->nome }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('games.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $jogo->id }}">
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>