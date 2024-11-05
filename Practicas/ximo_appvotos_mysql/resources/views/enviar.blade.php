<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Añadir Noticia</title>
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

    <!-- Formulario de Añadir Noticia -->
    <main class="container mx-auto mt-8 p-4">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
            <h3 class="text-2xl font-semibold text-center text-gray-800 mb-4">Añade una noticia</h3>
            <form method="POST" action="/store" class="space-y-4">
                @csrf

                <!-- Título -->
                <div>
                    <label for="titulo" class="block text-gray-700 font-semibold">Título</label>
                    <input type="text" name="titulo" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Noticia -->
                <div>
                    <label for="cuerpo" class="block text-gray-700 font-semibold">Noticia</label>
                    <textarea name="cuerpo" rows="6" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" required></textarea>
                </div>

                <!-- Enlace -->
                <div>
                    <label for="enlace" class="block text-gray-700 font-semibold">Enlace</label>
                    <input type="url" name="enlace" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Botón de Enviar -->
                <div class="text-center">
                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">Publicar Noticia</button>
                </div>
            </form>
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
