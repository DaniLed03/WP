<?php
// Incluye el archivo db.php para establecer la conexión
include 'db.php';

// Verifica si se proporcionó el ID del alumno en la URL
if(isset($_GET['id_alumno'])) {
    $id_alumno = $_GET['id_alumno'];

    // Consulta para obtener las materias asociadas a la carrera del alumno
    $sql_materias_carrera = "SELECT materias.id_materia, materias.nombre 
                             FROM materias 
                             INNER JOIN asignacion_materias_carrera ON materias.id_materia = asignacion_materias_carrera.id_materia 
                             INNER JOIN alumnos ON alumnos.id_carrera = asignacion_materias_carrera.id_carrera 
                             WHERE alumnos.id = $id_alumno";
    $result_materias_carrera = $conn->query($sql_materias_carrera);

    // Consulta para obtener todas las materias disponibles
    $sql_materias_disponibles = "SELECT * FROM materias";
    $result_materias_disponibles = $conn->query($sql_materias_disponibles);

    if ($result_materias_carrera->num_rows > 0 && $result_materias_disponibles->num_rows > 0) {
        $materias_carrera = array();
        while($row = $result_materias_carrera->fetch_assoc()) {
            $materias_carrera[] = $row['id_materia'];
        }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Materias a Alumno</title>
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

<!-- Menú lateral -->
<div class="sidebar">
    <h3>Menú Principal</h3>
    <a href="index.php" style="color: #fff;">Inicio</a> <!-- Agregar enlace para volver al menú principal -->
    <a href="listado_alumnos.php">Listado de Alumnos</a>
    <a href="alta_alumno.php">Agregar Alumno</a>
    <a href="listado_carreras.php">Listado de Carreras</a>
    <a href="alta_carrera.php">Agregar Carrera</a>
    <a href="listado_materias.php">Listado de Materias</a>
    <a href="alta_materia.php">Agregar Materia</a>
</div>

<!-- Contenido principal -->
<div class="content">
    <div class="container mt-5">
        <h1>Asignar Materias a Alumno</h1>
        <form action="crud.php" method="POST">
            <input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>">
            <div class="form-group">
                <label>Materias Disponibles:</label>
                <?php while($row_materia_disponible = $result_materias_disponibles->fetch_assoc()): ?>
                    <?php if (in_array($row_materia_disponible['id_materia'], $materias_carrera)): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="materias_asignadas[]" value="<?php echo $row_materia_disponible['id_materia']; ?>">
                            <label class="form-check-label">
                                <?php echo $row_materia_disponible['nombre']; ?>
                            </label>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <button type="submit" class="btn btn-primary" name="guardar_asignacion">Guardar Asignación</button>
        </form>
    </div>
</div>

</body>
</html>

<?php
    } else {
        echo "No hay materias disponibles asociadas a la carrera del alumno.";
    }
} else {
    // Redirige si no se proporciona el ID del alumno
    header("Location: listado_alumnos.php");
    exit();
}
?>
