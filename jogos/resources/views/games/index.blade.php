<x-layout title="Jogos">
    <div class="container divJogos">
        <div class="divJogoImagem">
            <img src="https:{{$jogos[0]['cover']['url']}}" alt="Imagem do jogo" class="imagemJogo">
            <p>{{$jogos[0]['name']}}</p>
        </div>

        <p>Plataformas</p>
        <ul>
        @foreach ($jogos[0]['platforms'] as $platform)
            <li>{{$platform['name']}}</li>
        @endforeach
        </ul>
    </div>

</x-layout>