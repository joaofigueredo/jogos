<x-layout title="Gerenciar Favoritos">
    @isset($jogos)
    @if(count($jogos) < 4) <h1><a href="">Adicionar Favorito</a></h1>

        @endif
        <div class="divFavorito mt-4">
            @foreach ($jogos as $jogo)

            <div class="card text-white bg-dark mb-3" style="width: 25%;">
                <img src="{{ $jogo->url_imagem }}" class=" img-fluid mx-auto mt-3" alt="imagem de {{ $jogo->nome }}">
                <div class="card-body divBotaoFavoritos">
                    <p class="card-text text-center">{{ $jogo->nome }}</p>
                    <form action="{{ route('favoritos.destroy', ['id' => $jogo->id]) }}" method="POST">
                        @csrf
                        <button class="botaoApagarFavorito" type="submit"><i class="bi bi-trash3"></i></button>
                    </form>
                </div>
            </div>

            @endforeach
        </div>
        @endisset
</x-layout>