<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos para los botones */
        .btn-purple {
            background-color: #6a0dad;
            color: #fff;
        }

        .btn-purple:hover {
            background-color: #8a56ac;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Menú Principal</h1>
        <div class="list-group">
            <a href="listado_alumnos.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Alumnos</a>
            <a href="alta_alumno.php" class="btn btn-purple btn-lg btn-block mb-2">Agregar Alumno</a>
            <a href="listado_carreras.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Carreras</a>
            <a href="alta_carrera.php" class="btn btn-purple btn-lg btn-block mb-2">Agregar Carrera</a>
            <a href="listado_materias.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Materias</a>
            <a href="alta_materia.php" class="btn btn-purple btn-lg btn-block">Agregar Materia</a>
        </div>
    </div>
</body>
</html>
