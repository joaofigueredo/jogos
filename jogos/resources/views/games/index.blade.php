<x-layout title="{{ $jogos[0]['name'] }}">
    <div class="container mx-auto mt-4">
        <div class="row">
            @foreach ($jogos as $jogo)
                <div class="col-md-4">
                    <div class="card-jogos">
                        @if(!empty($jogo['cover']['url']))
                            <img src="https:{{$jogo['cover']['url']}}" class="card-img-top imagem-jogo"
                            alt="Imagem do jogo {{$jogo['name']}}">
                        @else
                        <img src="{{ asset('images/img-nao-disponivel.png') }}" alt="Imagem não disponível" class="card-img-top imagem-jogo"> 
                        @endif
                        <div class="card-body">
                            <h5 class="card-title card-titulo-jogo">{{$jogo['name']}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Plataformas</h6>
                            <ul>
                                @if(!empty($jogo['platforms']))
                                    @foreach ($jogo['platforms'] as $platform)
                                        <li>{{$platform['name']}}</li>
                                    @endforeach
                                @endif
                                @if(empty($platform['name']))
                                    <li>---</li>
                                @endif

                            </ul>
                            <div class="botao-voltar">
                                <a href="{{ route('home.jogos') }}" class="btn btn-secondary botao-voltar">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>