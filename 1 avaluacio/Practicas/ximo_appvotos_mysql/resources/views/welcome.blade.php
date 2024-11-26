<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noticias</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Barra de navegación -->
    <header class="bg-gray-800 text-gray-100 shadow-lg p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Noticias</h1>
            <nav class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:underline text-white">Dashboard</a>
                    <a href="{{ url('/enviar') }}" class="hover:underline text-white">Enviar Noticia</a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline text-white">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hover:underline text-white">Registrar</a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container mx-auto mt-8 p-4">
        <h2 class="text-3xl font-semibold text-center mb-8 text-gray-800">Últimas Noticias</h2>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($noticias as $noticia)
                <div class="bg-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            <a href="{{ $noticia->enlace }}" class="text-blue-600 hover:underline">{{ $noticia->titulo }}</a>
                        </h3>
                        <p class="text-gray-700 text-sm mb-4">
                            {{ Str::limit($noticia->cuerpo, 100) }}
                        </p>
                        <p class="text-gray-600 text-xs">
                            Por {{ $noticia->user->name }} | {{ $noticia->votos_count ?? 0 }} Votos | 
                            <a href="/noticia/{{ $noticia->id }}" class="text-blue-500 hover:underline">
                                {{ $noticia->comentarios_count ?? 0 }} Comentarios
                            </a>
                        </p>

                        @auth
                            <form action="{{ url('/votar') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="noticia_id" value="{{ $noticia->id }}">
                                <button type="submit" class="bg-gray-500 text-black py-2 px-4 rounded-lg hover:bg-gray-600 w-full">
                                    Votar
                                </button>
                            </form>
                        @else
                            <p class="text-gray-500 text-xs mt-4 text-center">Inicia sesión para votar</p>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Noticias. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
