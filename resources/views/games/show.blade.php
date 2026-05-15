<x-layout title="Show">
    @isset($jogo[0])
    <div class="container">
        <section class="mx-auto my-5" style="max-width: 23rem;">
            <div class="card testimonial-card mt-2 mb-3">
                <div class="card-up aqua-gradient"></div>
                <div class="avatar mx-auto white">
                    <img src="{{ $jogo[0]->url_imagem }}" class="rounded-circle img-fluid"
                        alt="imagem de {{ $jogo[0]->nome }}">
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title font-weight-bold">{{ $jogo[0]->nome }}</h4>
                    <hr>
                    Critica:
                    <p><i class="bi bi-textarea-t"></i> {{ $jogo[0]->critica }}</p>
                </div>
            </div>
            @else
            <h3 class="text-center mt-2">Nenhum jogo encontrado!</h3>
            @endisset
</x-layout>