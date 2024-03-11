<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';

// Consultar todas las materias
$sql = "SELECT * FROM materias";
$result = $conn->query($sql);

// Exportar a Excel
if(isset($_POST['export_materias'])){
    $data = [];
    $columns = ['ID Materia', 'Nombre'];
    $data[] = $columns; // Agregar los nombres de las columnas como primera fila
    while($row = $result->fetch_assoc()){
        $data[] = [
            $row['id_materia'],
            $row['nombre']
        ];
    }
    exportToXLS('materias', $data); // Llamar a la función para exportar a Excel
}

// Función para exportar a Excel
function exportToXLS($filename, $data){
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $filename . '.xls"');

    // Crear tabla HTML para exportar a Excel
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
    <title>Listado de Materias</title>
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

<?php
// Incluir el archivo de conexión a la base de datos nuevamente para utilizarlo en el cuerpo del documento
include 'db.php';

// Consultar todas las materias
$sql = "SELECT * FROM materias";
$result = $conn->query($sql);
?>

<!-- Contenido principal -->
<div class="container mt-5 content">
    <h2>Listado de Materias</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Materia</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_materia'] ?></td>
                    <td><?php echo $row['nombre'] ?></td>
                    <td>
                        <a href="editar_materia.php?id_materia=<?= $row['id_materia'] ?>" class="btn btn-primary">Editar</a>
                        <a href="eliminar_materia.php?id_materia=<?= $row['id_materia'] ?>" class="btn btn-danger">Eliminar</a>
                    </td>   
                </tr> 
            <?php endwhile; ?>
        </tbody>
    </table>
    <!-- Formulario para exportar a Excel -->
    <form method="post">
        <button type="submit" name="export_materias" class="btn btn-success mb-3">Exportar a Excel</button>
    </form>
</div>

</body>
</html>
