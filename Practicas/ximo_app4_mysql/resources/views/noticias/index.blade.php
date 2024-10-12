<h1>Noticias</h1>

@if($noticias->isEmpty())
    <p>No se encontraron noticias.</p>
@else
    @foreach ($noticias as $noticia)
        <h2><a href="{{ url('/view/' . $noticia->id) }}">{{ $noticia->titulo }}</a></h2>
        <p>{{ $noticia->resumen }}</p>
    @endforeach

    {{ $noticias->links() }}
@endif
