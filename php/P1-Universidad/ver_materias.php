<?php
include 'db.php';

// Verifica si se proporcionó el ID del alumno en la URL
if(isset($_GET['id_alumno'])) {
    $id_alumno = $_GET['id_alumno'];

    // Consulta para obtener las materias asignadas al alumno
    $sql_materias_alumno = "SELECT materias.id_materia, materias.nombre, calificaciones.calificacion 
                            FROM materias 
                            INNER JOIN asignacion_materias_alumno ON materias.id_materia = asignacion_materias_alumno.id_materia 
                            LEFT JOIN calificaciones ON materias.id_materia = calificaciones.id_materia AND calificaciones.id_alumno = $id_alumno
                            WHERE asignacion_materias_alumno.id_alumno = $id_alumno";
    $result_materias_alumno = $conn->query($sql_materias_alumno);

    // Exportar a Excel
    if(isset($_POST['export_materias'])){
        $data = [];
        $columns = ['ID Materia', 'Nombre de la Materia', 'Calificación'];
        $data[] = $columns; // Agregar los nombres de las columnas como primera fila
        while($row = $result_materias_alumno->fetch_assoc()){
            $data[] = [
                $row['id_materia'],
                $row['nombre'],
                $row['calificacion'] ?? 'N/A' // Mostrar la calificación o 'N/A' si no tiene
            ];
        }
        exportToXLS('materias_alumno_'.$id_alumno, $data);
    }
} else {
    // Redirige si no se proporciona el ID del alumno
    header("Location: listado_alumnos.php");
    exit();
}

function exportToXLS($filename, $data){
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $filename . '.xls"');

    echo '<table border="1">';
    foreach ($data as $row) {
        echo '<tr>';
        foreach ($row as $cell) {
            echo '<td>' . $cell . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    exit; // Salir del script después de exportar a Excel
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias Asignadas al Alumno</title>
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
        <h1>Materias Asignadas al Alumno</h1>
        <h2>ID del Alumno: <?php echo $id_alumno; ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Materia</th>
                    <th>Nombre de la Materia</th>
                    <th>Calificación</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_materias_alumno->num_rows > 0) {
                    while($row = $result_materias_alumno->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_materia'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . ($row['calificacion'] ?? 'N/A') . "</td>"; // Mostrar la calificación o 'N/A' si no tiene
                        echo "<td>
                                <form action='crud.php' method='POST'>
                                    <input type='hidden' name='id_alumno' value='$id_alumno'>
                                    <input type='hidden' name='id_materia' value='".$row['id_materia']."'>
                                    <button type='submit' class='btn btn-danger mr-2' name='eliminar_materia_alumno'>Dar de Baja</button>
                                </form>
                              </td>"; // Botón para dar de baja la materia asignada al alumno
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay materias asignadas a este alumno.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="mb-3">
            <form action="asignar_calificacion.php" method="GET" style="display: inline;">
                <input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>">
                <button type="submit" class="btn btn-success mr-2">Asignar Calificaciones</button>
            </form>
            <form action="actualizar_calificaciones.php" method="GET" style="display: inline;">
                <input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>">
                <button type="submit" class="btn btn-success mr-2">Actualizar Calificaciones</button>
            </form>
            <form action="" method="POST" style="display: inline;">
                <input type="hidden" name="export_materias">
                <button type="submit" class="btn btn-primary">Exportar a Excel</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
