<?php
include 'db.php';

$id_carro = $_GET['id_carro'];
$sql = "SELECT * FROM carros WHERE id_carro = $id_carro";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de Carro</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <div class="content">
    <div class="container mt-5">
        <h2>Edición de Carro</h2>
        <!-- Formulario para editar carros -->
        <form action="crud.php" method="POST">
            <input type="hidden" name="id_carro" value="<?php echo $row['id_carro']; ?>">
            <div class="form-group">
                <label for="no_serie">No. de Serie:</label>
                <input type="text" class="form-control" id="no_serie" name="no_serie" value="<?php echo $row['no_serie']; ?>" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $row['marca']; ?>" required>
            </div>
            <div class="form-group">
                <label for="submarca">Submarca:</label>
                <input type="text" class="form-control" id="submarca" name="submarca" value="<?php echo $row['submarca']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $row['tipo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $row['modelo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" class="form-control" id="color" name="color" value="<?php echo $row['color']; ?>" required>
            </div>
            <div class="form-group">
                <label for="capacidad">Capacidad:</label>
                <input type="text" class="form-control" id="capacidad" name="capacidad" value="<?php echo $row['capacidad']; ?>" required>
            </div>
            <div class="form-group">
                <label for="año">Año:</label>
                <input type="text" class="form-control" id="año" name="año" value="<?php echo $row['año']; ?>" required>
            </div>
            <div class="form-group">
                <label for="procedencia">Procedencia:</label>
                <input type="text" class="form-control" id="procedencia" name="procedencia" value="<?php echo $row['procedencia']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="cambio_carro">Guardar Cambios</button>
        </form>
    </div>
</div>
</html>

