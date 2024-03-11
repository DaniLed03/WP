<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados para los botones */
        .btn-purple {
            background-color: #6a0dad; /* Color de fondo morado */
            color: #fff; /* Color de texto blanco */
        }

        .btn-purple:hover {
            background-color: #8a56ac; /* Cambio de color de fondo al pasar el ratón */
            color: #fff; /* Color de texto blanco */
        }
    </style>
</head>
<body>
    <!-- Contenedor principal con Bootstrap -->
    <div class="container mt-5">
        <h1>Menú Principal</h1>
        <!-- Lista de botones con Bootstrap -->
        <div class="list-group">
            <!-- Botón para ir al listado de alumnos -->
            <a href="listado_alumnos.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Alumnos</a>
            <!-- Botón para agregar un nuevo alumno -->
            <a href="alta_alumno.php" class="btn btn-purple btn-lg btn-block mb-2">Agregar Alumno</a>
            <!-- Botón para ir al listado de carreras -->
            <a href="listado_carreras.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Carreras</a>
            <!-- Botón para agregar una nueva carrera -->
            <a href="alta_carrera.php" class="btn btn-purple btn-lg btn-block mb-2">Agregar Carrera</a>
            <!-- Botón para ir al listado de materias -->
            <a href="listado_materias.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Materias</a>
            <!-- Botón para agregar una nueva materia -->
            <a href="alta_materia.php" class="btn btn-purple btn-lg btn-block">Agregar Materia</a>
        </div>
    </div>
</body>
</html>
