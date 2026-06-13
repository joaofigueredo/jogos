<x-layout title="Show">
    @isset($jogo[0])
    <div class="col mt-2">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden game-card bg-white">

                    <img src="{{$jogo[0]->url_imagem}}" class="card-img-top game-cover" alt="{{$jogo[0]->nome}}">

                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-dark mb-3 fs-3 text-center">{{$jogo[0]->nome}}</h5>

                        <hr class="my-4 text-muted opacity-25">

                        <div class="bg-light p-4 rounded-3">
                            <span class="text-uppercase text-muted fw-bold small d-block mb-2">Crítica</span>
                            <p class="mb-0 text-secondary fs-6 text-wrap" style="word-break: break-word;">
                                <i class="bi bi-chat-left-text me-2"></i>{{$jogo[0]->critica}}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    @else
    <h3 class="text-center mt-2">Nenhum jogo encontrado!</h3>
    @endisset
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>