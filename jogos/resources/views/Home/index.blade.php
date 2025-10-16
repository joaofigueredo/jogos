<x-layout title="Jogos">
    <div class="bodyHomeJogos">

        <div class="card-busca-links">
            <h2 class="form-title text-center">Buscar Jogo</h2>
            <div class="divBotoesBusca">
                <div>
                    <p class="tituloBusca">Buscar jogos</p>
                    <a href="{{ route('buscar.games') }}" class="btn-submit botaoLinks">Buscar</a>
                </div>
                <div>
                    <p class="tituloBusca">Buscar Jogos Similares</p>
                    <a href="{{ route('games.similar') }}" class="btn-submit botaoLinks">Buscar Similares</a>
                </div>
            </div>
        </div>
</x-layout>