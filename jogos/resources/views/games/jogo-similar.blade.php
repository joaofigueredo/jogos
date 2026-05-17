<x-layout title="Similares">
    <div class="container mx-auto mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card-jogos">
                    @if(!empty($jogo1[0]['cover']['url']))
                        <img src="https:{{$jogo1[0]['cover']['url']}}" class="card-img-top imagem-jogo"
                            alt="Imagem do jogo {{$jogo1[0]['name']}}">
                    @else
                        <img src="{{ asset('images/img-nao-disponivel.png') }}" alt="Imagem não disponível"
                            class="card-img-top imagem-jogo">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title card-titulo-jogo">{{ $jogo1[0]['name']}} </h5>
                        <h6 class="card-subtitle mb-2 text-muted">Plataformas</h6>
                        <ul>
                            @if(!empty($jogo1[0]['platforms']))
                                @foreach ($jogo1[0]['platforms'] as $platform)
                                    <li>{{$platform['name']}}</li>
                                @endforeach
                            @endif
                            @if(empty($platform['name']))
                                <li>---</li>
                            @endif

                        </ul>
                        <div class="botao-voltar">
                            <a href="{{ route('games.similar') }}" class="btn btn-secondary botao-voltar">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>