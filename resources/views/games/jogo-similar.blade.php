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
                        <div class="botaoVoltarAdicionar">
                            <form class="botaoAdd" action="{{ route('adicionar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_jogo" value="{{ $jogo1[0]['id'] }}">
                                <input type="hidden" name="nome" value="{{ $jogo1[0]['name'] }}">
                                <input type="hidden" name="cover" value="{{ $jogo1[0]['cover']['url'] }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>