<x-layout title="Jogos Similares">
    <div class="bodyHomeJogos">
        <div class="card-busca">
            <h2 class="form-title text-center">Buscar Jogos Similares</h2>
            <form action="{{ route('busca.similares') }}" method="POST" id="formBusca">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do jogo"
                        autofocus>
                </div>
                <button type="submit" class="btn-submit botao-buscar">Buscar</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>