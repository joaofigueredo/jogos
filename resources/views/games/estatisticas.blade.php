<x-layout title="Estatisticas">
    @isset($valores, $labels, $lista)
    <div class="container" style="max-width: 300px;">
        <canvas id="myChart"></canvas>
    </div>

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
                        borderColor: 'rgb(116, 75, 192)',
                        tension: 0.1
                    }]
                }
            });
        });
    </script>
    @endpush

    @foreach($jogos as $mes =>$lista)

    <h3>
        <h3 class="text-center mb-4 fw-bold">
            Jogados em {{ $mes }}
        </h3>
        @foreach ($lista as $jogo )

        <div class="news-container mt-2">
            <div class="list-group">
                <div class="news-item">
                    <div class="news-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="news-content">
                        <a href="{{ route('games.show', $jogo->id) }}" class="news-title">{{$jogo->nome }}</a>

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
                        <h3 class="text-center"> TOTAL: {{ count($lista) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
        @else
        <h1>Nenhum jogo</h1>
        @endisset
</x-layout>