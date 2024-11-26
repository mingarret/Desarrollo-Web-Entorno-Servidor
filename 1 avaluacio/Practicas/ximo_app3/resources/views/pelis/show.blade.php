<!-- resources/views/pelis/show.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de la Película</title>
</head>
<body>
    <h1>{{ $peli->name }}</h1>
    <p><strong>Año:</strong> {{ $peli->año }}</p>
    <p><strong>Creado en:</strong> {{ $peli->created_at }}</p>
    <p><strong>Última actualización:</strong> {{ $peli->updated_at }}</p>
    <a href="{{ route('pelis.index') }}">Volver al listado de películas</a>
</body>
</html>
