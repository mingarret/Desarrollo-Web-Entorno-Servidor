<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Películas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container mt-5">
    
    @if(session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif


    <h1>Listado de Películas</h1>
    <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#createModal">Añadir Película</button>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelis as $peli)
                <tr>
                    <td>{{ $peli->id }}</td>
                    <td><a href="{{ route('pelis.show', $peli->id) }}">{{ $peli->name }}</a></td>
                    <td>{{ $peli->año }}</td>
                    <td>
                        <button class="btn btn-primary editBtn" data-id="{{ $peli->id }}" data-name="{{ $peli->name }}" data-año="{{ $peli->año }}" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
                        <button class="btn btn-danger deleteBtn" data-id="{{ $peli->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>
                    </td>
                    <td>
                        <a href="{{ route('pelis.show', $peli->id) }}" class="btn btn-info">Ver Detalles</a>
                        <!-- Otros botones de Editar y Eliminar -->
                    </td>
                    
                </tr>
            @endforeach
        </tbody>        
    </table>
</div>

<!-- Modal para Crear Película -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pelis.store') }}" method="POST">
                @csrf <!-- Token CSRF obligatorio para formularios POST -->
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Añadir Película</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="año">Año</label>
                        <input type="number" class="form-control" id="año" name="año" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para Editar Película -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="editForm">
                @csrf
                <input type="hidden" name="_method" value="PUT"> <!-- Para simular el método PUT -->
                <input type="hidden" id="edit_id" name="id"> <!-- ID oculto de la película -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Película</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="edit_name">Nombre</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_año">Año</label>
                        <input type="number" class="form-control" id="edit_año" name="año" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para Eliminar Película -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="deleteForm">
                @csrf
                <input type="hidden" name="_method" value="DELETE"> <!-- Para simular el método DELETE -->
                <input type="hidden" id="delete_id" name="id"> <!-- ID oculto de la película -->
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Película</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro que deseas eliminar esta película?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Configuración CSRF para todas las solicitudes AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Código para manejar la creación
$('#createForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: "{{ route('pelis.store') }}",
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            location.reload();
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
});

// Establecer la acción y los datos del formulario de edición cuando se hace clic en "Editar"
$(document).on('click', '.editBtn', function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var año = $(this).data('año');
    
    // Actualizar la acción del formulario con la URL correcta
    $('#editForm').attr('action', '/pelis/update/' + id);
    
    // Rellenar los campos del formulario
    $('#edit_id').val(id);
    $('#edit_name').val(name);
    $('#edit_año').val(año);
});

// Establecer la acción y los datos del formulario de eliminación cuando se hace clic en "Eliminar"
$(document).on('click', '.deleteBtn', function() {
    var id = $(this).data('id');
    
    // Actualizar la acción del formulario con la URL correcta
    $('#deleteForm').attr('action', '/pelis/destroy/' + id);
    
    // Establecer el ID de la película a eliminar
    $('#delete_id').val(id);
});

</script>

<script>
    // Espera 5 segundos (5000 milisegundos) y luego desvanece el mensaje de éxito
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.transition = "opacity 1s";
            successMessage.style.opacity = "0";
            
            // Remueve el elemento del DOM después de la transición
            setTimeout(function() {
                successMessage.remove();
            }, 5000); // Tiempo de desvanecimiento de 5 segundo
        }
    }, 5000); // Espera de 5 segundos antes de comenzar el desvanecimiento
</script>


</body>
</html>
