<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Comment</title>
    <!-- Enlaza el CSS desde la carpeta public/css -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Create a New Comment</h1>

    <form action="/comments" method="POST">
        <!-- Laravel Token de protección CSRF si está activado -->
        <!-- @csrf -->

        <label for="comment">Comment:</label>
        <input type="text" id="comment" name="comment" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
