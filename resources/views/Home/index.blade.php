<x-layout title="Jogos">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/god-of-war.jpg') }}" class="carousel-img" alt="God of War">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('images/halo.jpg') }}" class="carousel-img" alt="Halo">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('images/cod.jpg') }}" class="carousel-img" alt="Call of Duty">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <div class="container">
        @isset($ultimo)
        <section class="mx-auto my-5" style="max-width: 23rem;">

            <div class="card testimonial-card mt-2 mb-3">
                <div class="card-up aqua-gradient"></div>
                <div class="avatar mx-auto white">
                    <img src="{{ $ultimo->url_imagem }}" class="rounded-circle img-fluid"
                        alt="imagem de {{ $ultimo->nome }}">
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title font-weight-bold">{{ $ultimo->nome }}</h4>
                    <hr>
                    <i class="fas fa-quote-left"></i> Último jogo finalizado!
                </div>
            </div>

            @else

            @endisset

        </section>
    </div>
</x-layout>