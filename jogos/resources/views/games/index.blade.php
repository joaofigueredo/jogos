<x-layout title="{{ $jogo[0]['name'] }}">
    <div class="divVoltarBuscaJogos">
        <a href="{{ route('buscar.games') }}" class="btn btn-secondary voltarBuscaJogos">Voltar</a>
    </div>
    <div class="container mx-auto mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card-jogos">
                    @if(!empty($jogo[0]['cover']['url']))
                        <img src="https:{{$jogo[0]['cover']['url']}}" class="card-img-top imagem-jogo"
                            alt="Imagem do jogo {{$jogo[0]['name']}}">
                    @else
                        <img src="{{ asset('images/img-nao-disponivel.png') }}" alt="Imagem não disponível"
                            class="card-img-top imagem-jogo">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title card-titulo-jogo">{{$jogo[0]['name']}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Plataformas</h6>
                        <ul>
                            @if(!empty($jogo[0]['platforms']))
                                @foreach ($jogo[0]['platforms'] as $platform)
                                    <li>{{$platform['name']}}</li>
                                @endforeach
                            @endif
                            @if(empty($platform['name']))
                                <li>---</li>
                            @endif

                        </ul>

                        <div class="botaoVoltarAdicionar" >
                            <form class="botaoAdd" action="{{ route('adicionar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $jogo[0]['id'] }}">
                                <input type="hidden" name="nome" value="{{ $jogo[0]['name'] }}">
                                <input type="hidden" name="cover" value="{{ $jogo[0]['cover']['url'] }}">
                                <input type="hidden" name="idJogador" value="{{ auth()->user()->id }}">
                                <button class="btn btn-secondary botao-voltar" type="submit">Adicionar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>