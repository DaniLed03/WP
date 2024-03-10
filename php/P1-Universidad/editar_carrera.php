<?php
include 'db.php';
$id_carrera = $_GET['id_carrera'];
$sql = "SELECT * FROM carrera WHERE id_carrera = $id_carrera";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<html>
<head>
    <title>Editar Carrera</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Carrera</h2>
    <form action="crud.php" method="POST">
        <input type="hidden" name="id_carrera" value="<?php echo $row['id_carrera'] ?>">
        <div class="form-group">
            <label for="nombre_carrera">Nombre de la carrera:</label>
            <input type="text" class="form-control" name="nombre_carrera" value="<?php echo $row['nombre'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="cambio_carrera">Guardar Cambios</button>
    </form>
</div>
</body>
</html>
