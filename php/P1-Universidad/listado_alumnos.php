<?php
include 'db.php'; // Incluir archivo de conexión a la base de datos

// Consulta para obtener todos los alumnos con sus carreras
$sql = "SELECT alumnos.*, carrera.nombre AS nombre_carrera 
        FROM alumnos 
        INNER JOIN carrera ON alumnos.id_carrera = carrera.id_carrera";
$result = $conn->query($sql); // Ejecutar la consulta

// Función para exportar los datos a Excel
if(isset($_POST['export_alumnos'])){
    $data = [];
    $columns = ['Matrícula', 'Nombre', 'Edad', 'Email', 'Carrera'];
    $data[] = $columns; // Agregar los nombres de las columnas como primera fila
    while($row = $result->fetch_assoc()){
        $data[] = [
            $row['matricula'],
            $row['nombre'],
            $row['edad'],
            $row['email'],
            $row['nombre_carrera']
        ];
    }
    exportToXLS('alumnos', $data);
}

// Función para exportar datos a Excel
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
    <title>Listado de Alumnos</title>
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
        <h2>Listado de Alumnos</h2>
        <!-- Tabla para mostrar los datos de los alumnos -->
        <table class="table">
            <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Email</th>
                <th>Carrera</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result->data_seek(0); // Resetear el puntero del resultado
            while ($row = $result->fetch_assoc()):
                ?>
                <!-- Filas de la tabla con los datos de cada alumno -->
                <tr>
                    <td><?php echo $row['matricula'] ?></td>
                    <td><?php echo $row['nombre'] ?></td>
                    <td><?php echo $row['edad'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['nombre_carrera'] ?></td>
                    <!-- Botones de acción para editar, asignar materias, ver materias y eliminar alumno -->
                    <td>
                        <a href="editar_alumno.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Editar</a>
                        <a href="asignar_materias_alumno.php?id_alumno=<?php echo $row['id']; ?>" class="btn btn-info">Asignar Materias</a>
                        <a href="ver_materias.php?id_alumno=<?php echo $row['id']; ?>" class="btn btn-success">Ver Materias</a> 
                        <form class="d-inline-block ml-2" action="crud.php?eliminar_alumno=<?php echo $row['id']; ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger" name="eliminar_alumno">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php
            endwhile; ?>
            </tbody>
        </table>
        <!-- Formulario para exportar los datos a Excel -->
        <form action="" method="POST">
            <input type="submit" name="export_alumnos" value="Exportar Excel" class="btn btn-success">
        </form>
    </div>
</div>

</body>
</html>
