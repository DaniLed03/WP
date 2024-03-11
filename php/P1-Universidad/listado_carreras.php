<?php
include 'db.php';

// Consulta para obtener todas las carreras
$sql = "SELECT * FROM carrera";
$result = $conn->query($sql);

// Exportar a Excel
if(isset($_POST['export_carreras'])){
    $data = [];
    $columns = ['ID Carrera', 'Nombre']; // Nombres de las columnas
    $data[] = $columns; // Agregar los nombres de las columnas como primera fila
    while($row = $result->fetch_assoc()){
        $data[] = [
            $row['id_carrera'],
            $row['nombre']
        ];
    }
    exportToXLS('carreras', $data);
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
    <title>Listado de Carreras</title>
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
        <h2>Listado de Carreras</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Carrera</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_carrera'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td>
                            <a href="editar_carrera.php?id_carrera=<?= $row['id_carrera'] ?>" class="btn btn-primary">Editar</a>
                            <form class="d-inline" action="crud.php?eliminar_carrera=<?php echo $row['id_carrera']?>" method="POST">
                                <input type="hidden" name="id_carrera" value="<?php echo $row['id_carrera'] ?>">
                                <button type="submit" class="btn btn-danger" name="eliminar_carrera">Eliminar</button>
                            </form>
                            <a href="asignar_materias_carrera.php?id_carrera=<?= $row['id_carrera'] ?>" class="btn btn-info">Asignar Materias</a>
                            <a href="ver_materias_carreras.php?id_carrera=<?= $row['id_carrera'] ?>" class="btn btn-success">Ver Materias</a> 
                        </td>   
                    </tr> 
                <?php endwhile; ?>
            </tbody>
        </table>
        <form action="" method="POST">
            <input type="submit" name="export_carreras" value="Exportar Excel" class="btn btn-success">
        </form>
    </div>
</div>

</body>
</html>

