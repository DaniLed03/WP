<?php
include 'db.php';

$id_materia = $_GET['id_materia'];
$sql = "SELECT * FROM materias WHERE id_materia = $id_materia";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Materia</h2>
        <form action="crud.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id_materia']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="cambio_materia">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
