<x-layout title="Gerenciar Favoritos">
    @isset($jogos)
    <div class="divFavorito mt-4">
        @foreach ($jogos as $jogo)

        <div class="card text-white bg-dark mb-3" style="width: 25%;">
            <img src="{{ $jogo->url_imagem }}" class=" img-fluid mx-auto mt-3" alt="imagem de {{ $jogo->nome }}">
            <div class="card-body divBotaoFavoritos">
                <p class="card-text text-center">{{ $jogo->nome }}</p>
                <form action="{{ route('favoritos.destroy', ['id' => $jogo->id]) }}" method="POST">
                    @csrf
                    <button class="botaoApagarFavorito" type="button" data-bs-toggle="modal"
                        data-bs-target="#attFavorito{{$jogo->id}}"><i class="bi bi-trash3"></i></button>

                    <div class="modal fade" id="attFavorito{{$jogo->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title textoModal">Confirmação</h5>
                                </div>
                                <div class="modal-body">
                                    <p class="textoModal">Tem certeza que deseja remover o favorito?</p>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button class="btn btn-primary" type="submit">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @endforeach
    </div>
    @endisset

    @if(count($jogos) < 4) <p><a href="{{ route('games.listajogos') }}" style="text-decoration: none;">
            Adicionar Favorito</a><i class="bi bi-save2"></i>
        </p>

        @endif
</x-layout>