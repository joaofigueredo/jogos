<x-layout title="Jogos">
    <div class="header-bg shadow-sm">
        <div class="container text-center">
            <h1 class="display-5 fw-bold">Bem-vindo ao Seu Hub de Jogos</h1>
            <p class="lead">Confira suas estatísticas e atividades recentes.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Estatísticas Rápidas</h4>

                        <div class="d-flex align-items-center mb-3">
                            <span class="stat-icon">🎮</span>
                            <div>
                                <h6 class="mb-0">Jogos Adquiridos</h6>
                                <p class="text-muted mb-0">{{$jogos}}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <span class="stat-icon">🕹️</span>
                            <div>
                                <h6 class="mb-0">Jogos zerados</h6>
                                <p class="text-muted mb-0">{{ $finalizados }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <span class="stat-icon">⭐</span>
                            <div>
                                <h6 class="mb-0">Último adicionado</h6>
                                <p class="text-muted mb-0">{{ $ultimos[0]->nome }}</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-8">

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Atividade Recente</h4>
                        <ul class="recent-activity-list">
                            @foreach ($ultimos as $ultimo)
                            @if($ultimo->finalizado == true)
                            <li><strong
                                    class="text-primary">{{ \Carbon\Carbon::parse($ultimo->updated_at)->locale('pt_BR')->translatedFormat('d \d\e F') }}</strong>
                                zerou <span class="text-warning fw-bold">{{ $ultimo->nome }}</span>
                            </li>
                            @else
                            <li><strong
                                    class="text-primary">{{ \Carbon\Carbon::parse($ultimo->created_at)->locale('pt_BR')->translatedFormat('d \d\e F') }}</strong>
                                adicionou <span class="text-warning fw-bold">{{ $ultimo->nome }}</span>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Minha Biblioteca de Jogos</h4>
                        <div class="row text-center">

                            @foreach ($ultimos as $ultimo)
                            <div class="col-6 col-sm-4 mb-3">
                                <img src="{{ $ultimo->url_imagem }}" alt="Subnautica Pack"
                                    class="img-fluid game-cover shadow-sm" style="height: 100px;">
                                <h6>{{ $ultimo->nome }}</h6>
                                @if($ultimo->finalizado == true)
                                <p class="text-muted small">Finalizado!</p>
                                @else
                                <p class="text-muted small">Biblioteca</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>