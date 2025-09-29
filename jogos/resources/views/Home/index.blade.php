<x-layout title="Home">
    <div class="divHome container">
    <form action="{{ route('busca.games') }}" method="POST" id="formBusca">
        @csrf
        <div class="form-group row">
             <div class="form-group mb-2">
                <label for="nome" class="">Nome</label>
                <input type="text" class="" id="nome" name="nome" placeholder="Nome do jogo">
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </form>
    </div>
</x-layout>