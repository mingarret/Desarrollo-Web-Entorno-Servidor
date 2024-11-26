<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Comments</title>
    <!-- Enlaza el CSS desde la carpeta public/css -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Comments List</h1>

    @if (count($comments) > 0)
        <ul>
            @foreach ($comments as $index => $comment)
                <li>
                    <strong>ID: {{ $index }}</strong> - {{ $comment }}
                    <!-- Links para ver, editar o eliminar el comentario -->
                    <a href="/comments/{{ $index }}">View</a> | 
                    <a href="/comments/{{ $index }}/edit">Edit</a> | 
                    <form action="/comments/{{ $index }}" method="POST" style="display:inline;">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No comments found.</p>
    @endif

    <a href="/comments/create">Add a new comment</a>
</body>
</html>
