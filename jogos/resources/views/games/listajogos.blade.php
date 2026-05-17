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
                                    <th>Jogo</th>
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
                                                        <h5 class="mb-0"><a href="#">{{ $jogo->nome }}</a></h5>
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
                                                <li><a href="#" class="text-info" data-toggle="tooltip" title=""
                                                        data-original-title="Edit"><i class="bi bi-pencil"></i></a>
                                                </li>
                                                <form action="{{ route('games.destroy') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $jogo->id }}">
                                                    <li><button class="botaoSalvarJogo" type="submit"><i class="bi bi-trash3"></i></button></li>
                                                </form>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="textoTotal">Total</td>
                                    <td class="numeroTotal" colspan="6">{{ $total }}</td>
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