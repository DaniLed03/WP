<?php
include 'db.php';
// Consulta para obtener todos los alumnos con sus carreras
$sql = "SELECT alumnos.*, carrera.nombre AS nombre_carrera 
        FROM alumnos 
        INNER JOIN carrera ON alumnos.id_carrera = carrera.id_carrera";
$result = $conn->query($sql);

// Exportar a Excel
if(isset($_POST['export_alumnos'])){
    $data = [];
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

function exportToXLS($filename, $data){
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $filename . '.xls"');

    echo '<table border="1">';
    foreach ($data as $row) {
        echo '<tr>';
        foreach ($row as $column) {
            echo '<td>' . $column . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>

<html lang="es">
<head>
    <title>Listado de Alumnos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Listado de Alumnos</h2>
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
        while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['matricula'] ?></td>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo $row['edad'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['nombre_carrera'] ?></td>
                <td>
                    <a href="editar_alumno.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="asignar_materias_alumno.php?id_alumno=<?php echo $row['id']; ?>" class="btn btn-info">Asignar Materias</a>
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
    <form action="" method="POST">
        <input type="submit" name="export_alumnos" value="Exportar Excel" class="btn btn-success">
    </form>
    <a href="alta_alumno.php" class="btn btn-primary">Agregar Alumno</a>
</div>
</body>
</html>
