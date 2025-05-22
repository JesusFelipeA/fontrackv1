<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FCE8D5;
            /* Color cálido y natural */
            color: #634D3B;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            background: #FFF;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #E38B5B;
            /* Color principal */
            font-size: 2em;
            font-weight: bold;
        }

        .btn {
            background-color: #E38B5B;
            /* Botón con tono cálido */
            color: #fff;
            font-size: 1.2em;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #D1784C;
            transform: scale(1.05);
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead {
            background-color: #F6B88F;
            color: #fff;
        }

        .table th,
        .table td {
            padding: 15px;
        }

        .modal-header {
            background-color: #F6B88F;
            color: #fff;
        }

        .modal-footer {
            background-color: #FCE8D5;
        }

        /* Mejoramos la interfaz de los botones dentro de la tabla */
        .btn-info {
            background-color: #88C0D0;
            border: none;
        }

        .btn-warning {
            background-color: #E5A34D;
            border: none;
        }

        .btn-danger {
            background-color: #D9534F;
            border: none;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 15px;
            list-style: none;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a,
        .pagination li span {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #E38B5B;
            /* Color Bonafont */
            color: white;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .pagination li a:hover {
            background-color: #D1784C;
            transform: scale(1.1);
        }

        .pagination .active span {
            background-color: #F6B88F;
            /* Color más suave para resaltar página actual */
            color: #fff;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Usuarios</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistro"
            id="btnNuevoUsuario">Registrar Usuario</button>
        <table class="table mt-3" id="tablaUsuarios">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr data-id="{{ $usuario->id_usuario }}">
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->correo }}</td>
                        <td>{{ $usuario->tipo_usuario }}</td>
                        <td>
                            <button class="btn btn-info btnVer" data-id="{{ $usuario->id_usuario }}">Ver</button>
                            <button class="btn btn-warning btnEditar" data-id="{{ $usuario->id_usuario }}">Editar</button>
                            <button class="btn btn-danger btnEliminar"
                                data-id="{{ $usuario->id_usuario }}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Sección de paginación -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $usuarios->links('pagination::bootstrap-5') }}
        </div>

    </div>

    <!-- Modal Registro/Edición -->
    <div class="modal fade" id="modalRegistro" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formRegistro">
                    @csrf
                    <input type="hidden" id="usuarioId">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrar / Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>

                        <label for="correo" class="mt-2">Correo:</label>
                        <input type="email" id="correo" name="correo" class="form-control" required>

                        <label for="password" class="mt-2">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Deja vacío para no cambiarla">

                        <label for="tipo_usuario" class="mt-2">Tipo de Usuario:</label>
                        <select id="tipo_usuario" name="tipo_usuario" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnGuardarUsuario">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ver Usuario -->
    <div class="modal fade" id="modalVer" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <span id="verNombre"></span></p>
                    <p><strong>Correo:</strong> <span id="verCorreo"></span></p>
                    <p><strong>Tipo:</strong> <span id="verTipo"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#btnNuevoUsuario').click(function () {
                $('#usuarioId, #nombre, #correo, #password').val('');
                $('#tipo_usuario').val('1');
            });

            $('#formRegistro').submit(function (event) {
                event.preventDefault();
                let id = $('#usuarioId').val();
                let url = id ? `/update_user/${id}` : `/register_user`;
                let method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        const res = xhr.responseJSON;
                        if (res?.errors) {
                            let errores = Object.values(res.errors).flat().join('\n');
                            alert('Errores:\n' + errores);
                        } else {
                            alert('Error: ' + xhr.responseText);
                        }
                    }
                });
            });

            $('.btnEditar').click(function () {
                let id = $(this).data('id');
                $.get(`/edit_user/${id}`, function (response) {
                    let data = response.data;
                    $('#usuarioId').val(id);
                    $('#nombre').val(data.nombre);
                    $('#correo').val(data.correo);
                    $('#tipo_usuario').val(data.tipo_usuario);
                    $('#password').val('');
                    $('#modalRegistro').modal('show');
                });
            });

            $('.btnVer').click(function () {
                let id = $(this).data('id');
                $.get(`/users/${id}`, function (response) {
                    let data = response.data;
                    $('#verNombre').text(data.nombre);
                    $('#verCorreo').text(data.correo);
                    $('#verTipo').text(data.tipo_usuario == 1 ? 'Admin' : 'Usuario');
                    $('#modalVer').modal('show');
                });
            });

            $('.btnEliminar').click(function () {
                let id = $(this).data('id');
                if (confirm('¿Seguro que quieres eliminar este usuario?')) {
                    $.ajax({
                        url: `/delete_user/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            alert(response.message);
                            $(`tr[data-id="${id}"]`).remove();
                        },
                        error: function (xhr) {
                            alert('Error al eliminar usuario: ' + xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>