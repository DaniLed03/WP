<?php
// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Verifica si se proporcionó el ID de la carrera en la URL
if(isset($_GET['id_carrera'])) {
    $id_carrera = $_GET['id_carrera'];

    // Consulta para obtener las materias disponibles
    $sql_materias = "SELECT * FROM materias";
    $result_materias = $conn->query($sql_materias);
} else {
    // Redirige si no se proporciona el ID de la carrera
    header("Location: listado_carreras.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Materias a Carrera</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos para el menú lateral */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #6a0dad; /* Cambio de color a morado */
            padding-top: 20px;
            text-align: center; /* Centrar el texto */
        }

        .sidebar h3 {
            color: #fff; /* Cambio de color de texto a blanco */
            font-weight: bold; /* Texto en negritas */
            margin-bottom: 20px; /* Espacio inferior */
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            color: #fff; /* Cambio de color de texto a blanco */
        }

        .sidebar a:hover {
            background-color: #8a56ac; /* Cambio de color de fondo al hacer hover */
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Menú Principal</h3>
    <a href="index.php" style="color: #fff;">Inicio</a> <!-- Agregar enlace para volver al menú principal -->
    <!-- Enlaces para otras páginas -->
    <a href="listado_alumnos.php">Listado de Alumnos</a>
    <a href="alta_alumno.php">Agregar Alumno</a>
    <a href="listado_carreras.php">Listado de Carreras</a>
    <a href="alta_carrera.php">Agregar Carrera</a>
    <a href="listado_materias.php">Listado de Materias</a>
    <a href="alta_materia.php">Agregar Materia</a>
</div>

<div class="content">
    <div class="container mt-5">
        <h1>Asignar Materias a Carrera</h1>
        <!-- Formulario para asignar materias a la carrera -->
        <form action="crud.php" method="POST">
            <input type="hidden" name="id_carrera" value="<?php echo $_GET['id_carrera']; ?>">
            <div class="form-group">
                <label>Materias Disponibles:</label>
                <!-- Bucle para mostrar las materias disponibles como checkboxes -->
                <?php 
                if ($result_materias->num_rows > 0) {
                    while($row_materia = $result_materias->fetch_assoc()): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="materias_asignadas[]" value="<?php echo $row_materia['id_materia']; ?>">
                            <label class="form-check-label">
                                <?php echo $row_materia['nombre']; ?>
                            </label>
                        </div>
                    <?php endwhile;
                } else {
                    echo "No hay materias disponibles.";
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary" name="asignar_materias_carrera">Asignar Materias</button>
        </form>
    </div>
</div>

</body>
</html>
