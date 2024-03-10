<?php
include 'db.php';
// Consulta para obtener todas las carreras
$sql = "SELECT * FROM carrera";
$result = $conn->query($sql);

// Exportar a Excel
if(isset($_POST['export_carreras'])){
    $data = [];
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
    <title>Listado de Carreras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
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
                    </td>   
                </tr> 
            <?php endwhile; ?>
        </tbody>
    </table>
    <form action="" method="POST">
        <input type="submit" name="export_carreras" value="Exportar Excel" class="btn btn-success">
    </form>
    <a href="alta_carrera.php" class="btn btn-success">Agregar Carrera</a>
</div>
</body>
</html>
