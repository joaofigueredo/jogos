<x-layout title="Jogos">
    <div class="d-none d-md-flex justify-content-between w-100 px-5">
        <i class="bi bi-playstation text-secondary" style="font-size: 5rem; opacity: 0.4;"></i>
        <i class="bi bi-xbox text-secondary" style="font-size: 5rem; opacity: 0.4;"></i>
    </div>
    <main class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="card p-5 shadow border-0 rounded-4" style="max-width: 500px; width: 100%; background: #ffffff;">

            <h2 class="text-center fw-bold text-dark mb-4">Buscar Jogo</h2>

            <form action="{{ route('busca.games') }}" method="POST" id="formBusca">
                @csrf
                <div class="mb-4">
                    <label for="nomeJogo" class="form-label text-secondary fw-medium small mb-2">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-secondary">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" id="nome" name="nome"
                            placeholder="Digite o nome do jogo" autofocus>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-custom-green  fw-bold py-2-5 rounded-3 shadow-sm">
                        Buscar
                    </button>
                </div>
            </form>

        </div>
    </main>

    <div class="d-none d-md-flex justify-content-between w-100 px-5">
        <i class="bi bi-nintendo-switch text-secondary" style="font-size: 5rem; opacity: 0.4;"></i>
        <i class="bi bi-steam text-secondary" style="font-size: 5rem; opacity: 0.4;"></i>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>