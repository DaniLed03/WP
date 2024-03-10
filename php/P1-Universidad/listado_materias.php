<?php
include 'db.php';

$sql = "SELECT * FROM materias";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Materias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
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
        <a href="alta_materia.php" class="btn btn-success">Agregar Materia</a>
    </div>
</body>
</html>
