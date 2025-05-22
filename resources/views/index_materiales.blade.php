<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="../">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <title>Lista de Materiales - FontTrack</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FCE8D5;
            color: #634D3B;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            background: #FFF;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #E38B5B;
            font-size: 1.8em;
            font-weight: bold;
        }

        /* Botón principal */
        .btn {
            background-color: #E38B5B;
            color: #fff;
            font-size: 0.85em;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-sm {
            font-size: 0.75em;
            padding: 5px 10px;
        }

        .btn:hover {
            background-color: #D1784C;
            transform: scale(1.05);
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

        /* Tabla responsiva */
        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }

        /* Estilos para la tabla */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background-color: #F6B88F;
            color: #fff;
        }

        .table th,
        .table td {
            padding: 10px;
            font-size: 14px;
            text-align: center;
            white-space: nowrap;
        }

        /* Paginación */
        .pagination {
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a,
        .pagination li span {
            text-decoration: none;
            padding: 8px 12px;
            background-color: #E38B5B;
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
            color: #fff;
            border-radius: 6px;
            font-weight: bold;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            h2 {
                font-size: 1.5em;
            }

            .table th,
            .table td {
                font-size: 12px;
                padding: 8px;
            }

            .btn {
                font-size: 0.8em;
                padding: 6px 12px;
            }

            .pagination li a,
            .pagination li span {
                padding: 6px 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Lista de Materiales</h2>
        <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalRegistro"
            id="btnNuevoMaterial">
            Registrar Material
        </button>

        <div class="table-responsive">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Genérico</th>
                        <th>Clasificación</th>
                        <th>Existencia</th>
                        <th>Costo ($)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materiales as $material)
                        <tr data-id="{{ $material->id }}">
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->clave_material }}</td>
                            <td>{{ $material->descripcion }}</td>
                            <td>{{ $material->generico }}</td>
                            <td>{{ $material->clasificacion }}</td>
                            <td>{{ $material->existencia }}</td>
                            <td>{{ $material->costo_promedio }}</td>
                            <td class="d-flex flex-column flex-md-row">
                                <button class="btn btn-info btn-sm btnVer mb-1 mb-md-0"
                                    data-id="{{ $material->id_material }}">Ver</button>
                                <button class="btn btn-warning btn-sm btnEditar mx-md-1 mb-1 mb-md-0"
                                    data-id="{{ $material->id_material }}">Editar</button>
                                <button class="btn btn-danger btn-sm btnEliminar"
                                    data-id="{{ $material->id_material }}">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $materiales->links('pagination::bootstrap-5') }}
        </div>
    </div>
</body>

</html>