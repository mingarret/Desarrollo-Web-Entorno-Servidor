<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Catálogo de Productos')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="wrapper" style="min-height: 100vh; display: flex; flex-direction: column;">
        <div class="content" style="flex: 1;">
            @yield('content')
        </div>
        @include('partials.footer')
    </div>
</body>
</html>
