<x-layout title="Seus jogos">
    <div class="container mt-3 mb-4 div-central-jogos">
        <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                        @if(!$jogos->isEmpty())
                        <table class="table manage-jogos-top mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <h3>Jogo</h3>
                                    </th>
                                    <th class="text-center">Status</th>
                                    <th class="action text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp

                                @foreach($jogos as $jogo)
                                @php $total++; @endphp
                                <tr class="jogos-list">
                                    <td class="title">
                                        <div class="thumb">
                                            <img class="img-fluid" src="{{ $jogo->url_imagem }}" alt="">
                                        </div>
                                        <div class="jogo-list-details">
                                            <div class="jogo-list-info">
                                                <div class="jogo-list-title">
                                                    <a class="linkJogo"
                                                        href="{{ route('games.show', ['id' => $jogo->id]) }}">
                                                        <h5 class="mb-0">{{ $jogo->nome }}</h5>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="jogo-list-favourite-time text-center">
                                        <a class="jogo-list-favourite order-2 text-danger" href="#"><i
                                                class="fas fa-heart"></i></a>
                                        <span class="jogo-list-time order-1">Finalizado</ span>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <form action="{{ route('busca.similares') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="nome" value="{{ $jogo->nome }}">
                                                <li>
                                                    <button class="botaoSalvarJogo" type="submit"><i
                                                            class="bi bi-lightbulb-fill"></i></button>
                                                </li>
                                            </form>
                                            <li><button class="botaoSalvarJogo" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#apagarJogo{{ $jogo->id }}"><i
                                                        class="bi bi-trash3"></i></button>
                                            </li>

                                            <!-- modal -->
                                            <div class="modal fade" id="apagarJogo{{ $jogo->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirmação</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem certeza que deseja excluir {{ $jogo->nome }}?
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('games.destroy') }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="id" value="{{ $jogo->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Confirmar</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="textoTotal">Total</td>
                                    <td class="numeroTotal text-center" colspan="6">{{ $total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        @endif
                        @if($jogos->isEmpty())
                        <h3 class="testoSemJogos">Nenhum jogo na sua lista!</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>