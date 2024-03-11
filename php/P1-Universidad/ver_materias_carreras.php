<?php
include 'db.php';

// Verifica si se proporcionó el ID de la carrera en la URL
if(isset($_GET['id_carrera'])) {
    $id_carrera = $_GET['id_carrera'];

    // Consulta para obtener las materias asignadas a la carrera
    $sql_materias_carrera = "SELECT materias.id_materia, materias.nombre 
                             FROM materias 
                             INNER JOIN asignacion_materias_carrera ON materias.id_materia = asignacion_materias_carrera.id_materia 
                             WHERE asignacion_materias_carrera.id_carrera = $id_carrera";
    $result_materias_carrera = $conn->query($sql_materias_carrera);
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
    <title>Materias Asignadas a la Carrera</title>
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
    <a href="listado_alumnos.php">Listado de Alumnos</a>
    <a href="alta_alumno.php">Agregar Alumno</a>
    <a href="listado_carreras.php">Listado de Carreras</a>
    <a href="alta_carrera.php">Agregar Carrera</a>
    <a href="listado_materias.php">Listado de Materias</a>
    <a href="alta_materia.php">Agregar Materia</a>
</div>

<div class="content">
    <div class="container mt-5">
        <h1>Materias Asignadas a la Carrera</h1>
        <h2>ID de la Carrera: <?php echo $id_carrera; ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de la Materia</th>
                    <th>Acciones</th> <!-- Nueva columna para acciones -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_materias_carrera->num_rows > 0) {
                    $count = 1;
                    while($row = $result_materias_carrera->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td><form action='crud.php' method='POST'><input type='hidden' name='id_carrera' value='$id_carrera'><input type='hidden' name='id_materia' value='".$row['id_materia']."'><button type='submit' class='btn btn-danger' name='eliminar_materia_carrera'>Eliminar</button></form></td>"; // Botón para eliminar la materia de la carrera
                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay materias asignadas a esta carrera.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
