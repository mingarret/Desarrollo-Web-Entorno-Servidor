<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comentario - {{ $noticia->titulo }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Barra de navegación -->
    <header class="bg-gray-800 text-gray-100 shadow-lg p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Noticias</h1>
            <nav class="space-x-4">
                <a href="{{ url('/') }}" class="hover:underline">Inicio</a>
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
        <!-- Noticia principal -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden p-6 mb-6">
            <h2 class="text-3xl font-bold text-blue-600 mb-2">{{ $noticia->titulo }}</h2>
            <p class="text-gray-500 text-sm mb-4">Por {{ $noticia->user->name }} | {{ $noticia->created_at->diffForHumans() }}</p>
            <p class="text-gray-700 text-base mb-4">{{ $noticia->cuerpo }}</p>
        </div>

        <!-- Sección de comentarios -->
        <div class="bg-gray-50 rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4">Comentarios</h3>

            <!-- Formulario para agregar un comentario -->
            @auth
                <form action="{{ route('comentarios.store', $noticia->id) }}" method="POST" class="mb-6">
                    @csrf
                    <textarea name="cuerpo" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe un comentario..." required></textarea>
                    <button type="submit" class="bg-gray-800 text-white py-2 px-4 mt-2 rounded-lg hover:bg-gray-900">Publicar Comentario</button>
                </form>
            @else
                <p class="text-gray-500 mb-4">Inicia sesión para comentar.</p>
            @endauth

            <!-- Listado de comentarios y respuestas -->
            @foreach ($noticia->comentarios as $comentario)
                <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                    <p class="text-gray-700">{{ $comentario->cuerpo }}</p>
                    <p class="text-gray-500 text-xs">Por {{ $comentario->user->name }} | {{ $comentario->created_at->diffForHumans() }}</p>

                    <!-- Respuestas anidadas -->
                    @if ($comentario->replies)
                        <div class="bg-gray-100 rounded-lg p-4 mt-2 ml-4">
                            @foreach ($comentario->replies as $reply)
                                <div class="mb-2">
                                    <p class="text-gray-600">{{ $reply->cuerpo }}</p>
                                    <p class="text-gray-400 text-xs">Por {{ $reply->user->name }} | {{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Formulario de respuesta a un comentario -->
                    @auth
                        <form action="{{ route('comentarios.reply', $comentario->id) }}" method="POST" class="mt-4">
                            @csrf
                            <textarea name="cuerpo" rows="2" class="w-full p-2 border border-gray-300 rounded-lg mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Responder a este comentario..." required></textarea>
                            <button type="submit" class="bg-gray-800 text-white py-1 px-3 rounded-lg hover:bg-gray-800">Responder</button>
                        </form>
                    @endauth
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
