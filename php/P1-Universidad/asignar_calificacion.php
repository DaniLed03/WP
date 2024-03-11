<?php
include 'db.php';

// Verifica si se proporcionó el ID del alumno en la URL
if(isset($_GET['id_alumno'])) {
    $id_alumno = $_GET['id_alumno'];

    // Consulta para obtener las materias asignadas al alumno
    $sql_materias_alumno = "SELECT materias.id_materia, materias.nombre 
                            FROM materias 
                            INNER JOIN asignacion_materias_alumno ON materias.id_materia = asignacion_materias_alumno.id_materia 
                            WHERE asignacion_materias_alumno.id_alumno = $id_alumno";
    $result_materias_alumno = $conn->query($sql_materias_alumno);
    
    // Verifica si se envió el formulario para asignar calificaciones
    if(isset($_POST['guardar_calificaciones'])) {
        foreach($_POST['calificaciones'] as $id_materia => $calificacion) {
            // Inserta las calificaciones en la base de datos
            $sql_insert_calificacion = "INSERT INTO calificaciones (id_alumno, id_materia, calificacion) 
                                        VALUES ($id_alumno, $id_materia, $calificacion)";
            $result_insert_calificacion = $conn->query($sql_insert_calificacion);
        }
        
        // Redirige a la página ver_materias.php después de guardar las calificaciones
        header("Location: ver_materias.php?id_alumno=$id_alumno");
        exit();
    }
} else {
    // Redirige si no se proporciona el ID del alumno
    header("Location: listado_alumnos.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Calificaciones</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- Estilos adicionales -->
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

        /* Estilos para los elementos del menú lateral */
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
    <!-- Enlaces a otras páginas -->
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
        <h1>Asignar Calificaciones al Alumno</h1>
        <h2>ID del Alumno: <?php echo $id_alumno; ?></h2>
        <!-- Formulario para ingresar calificaciones -->
        <form action="" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Materia</th>
                        <th>Nombre de la Materia</th>
                        <th>Ingresar Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo PHP para mostrar las materias y los campos de calificación -->
                    <?php
                    if ($result_materias_alumno->num_rows > 0) {
                        while($row = $result_materias_alumno->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id_materia'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td><input type='number' name='calificaciones[".$row['id_materia']."]' step='1' min='0' max='100' required></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay materias asignadas a este alumno.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary" name="guardar_calificaciones">Guardar</button>
        </form>
    </div>
</div>

</body>
</html>
