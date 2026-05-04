<x-layout title="Estatisticas">
    <h1 class="text-center">Estatisticas</h1>

    @foreach($jogos as $mes =>$lista)
    <h3>jogados em {{ $mes }}</h3>


    <div class="row">
        @foreach ($lista as $jogo )
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card testimonial-card h-100">
                <div class="card-up aqua-gradient"></div>

                <div class="avatar mx-auto white">
                    <img src="{{ $jogo->url_imagem }}" class="rounded-circle img-fluid"
                        alt="imagem de {{ $jogo->nome }}">
                </div>

                <div class="card-body text-center">
                    <h4 class="card-title font-weight-bold">{{ $jogo->nome }}</h4>
                    <hr>
                    <i class="fas fa-quote-left"></i> Último jogo finalizado!
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach


</x-layout>