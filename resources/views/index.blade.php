<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Usuarios</h1>

        <div class="text-center mb-3">
            <a href="{{ route('register_user') }}" class="btn btn-success">Registrar Nuevo Usuario</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Contraseña</th>
                        <th>Tipo de Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id_usuario }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->correo }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->tipo_usuario }}</td>
                            <td>
                                <a href="{{ route('user_detail', $user->id_usuario) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('edit_user', $user->id_usuario) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('delete_user', $user->id_usuario) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
