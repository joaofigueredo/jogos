<x-layout title="Jogos">
    <div class="divVoltarBuscaJogos">
        <a href="{{ route('buscar.games') }}" class="btn btn-secondary voltarBuscaJogos">Voltar</a>
    </div>



    <div class="container mt-2">
        <div class="row">
            @foreach ($jogos as $jogo)
            <div class="col-md-4">
                <div class="card-jogos">
                    @if(!empty($jogo['cover']['url']))
                    <img src="https:{{$jogo['cover']['url']}}" class="card-img-top imagem-jogo"
                        alt="Imagem do jogo {{$jogo['name']}}">
                    @else
                    <img src="{{ asset('images/img-nao-disponivel.png') }}" alt="Imagem não disponível"
                        class="card-img-top imagem-jogo">
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
                        @if(!empty($jogo['cover']['url']))
                        <div class="botaoVoltarAdicionar">
                            <form class="botaoAdd" action="{{ route('adicionar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_jogo" value="{{ $jogo['id'] }}">
                                <input type="hidden" name="nome" value="{{ $jogo['name'] }}">
                                <input type="hidden" name="cover" value="{{ $jogo['cover']['url'] }}">
                                <input type="hidden" name="idJogador" value="{{ auth()->user()->id }}">

                                <button type="button" class="botaoSalvarJogo" data-bs-toggle="modal"
                                    data-bs-target="#addJogo">Adicionar</button>

                                <!-- modal -->
                                <div class="modal fade" id="addJogo" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmação</h5>
                                            </div>
                                            <div class="modal-body">
                                                <textarea type="text" id="critica" name="critica"
                                                    class="form-control form-control-lg"
                                                    placeholder="Critica"></textarea>
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
                        </div>
                        @else
                        <p>Impossivel adicionar por falta de informações</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>