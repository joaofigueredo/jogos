<x-layout title="Estatisticas">
    @isset($valores, $labels, $jogos)
    <div class="container" style="max-width: 300px;">
        <canvas id="myChart"></canvas>
    </div>
    @foreach($jogos as $mes =>$lista)
    <h3>
        <h3 class="text-center mb-4 fw-bold">
            Jogados em {{ $mes }}
        </h3>
        @foreach ($lista as $jogo )

        <div class="news-container mt-2">
            <div class="list-group">
                <div class="news-item d-flex align-items-center">
                    <div class="news-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="news-content">
                        <div class="news-thumb">
                            <img class="img-fluid imagemThumb" src="{{ $jogo->url_imagem }}" alt="">
                        </div>
                        <div>
                            <a href="{{ route('games.show', $jogo->id) }}" class="news-title">{{$jogo->nome }}</a>
                        </div>
                    </div>
                    <div class="news-date">
                        <span>
                            {{ $jogo->created_at->locale('pt_BR')->translatedFormat('d') }}</span>
                        {{ $jogo->created_at->locale('pt_BR')->translatedFormat('F') }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="news-container mt-2">
            <div class="list-group">
                <div class="news-item">
                    <div class="news-content">
                        <p class="text-center"> TOTAL:</p>
                        <p class="text-end">{{ count($lista) }}</p>
                    </div>
                </div>
            </div>
        </div>


        @endforeach
        @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Jogos mensais',
                        data: @json($valores),
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                }
            });
        });
        </script>
        @endpush
        @else
        <h1>Nenhum jogo</h1>
        @endisset

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>