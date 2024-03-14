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
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #333;
            padding: 10px 20px;
        }
        .navbar-brand {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-align: center; /* Centra el texto "Menú Principal" */
            margin-right: center; /* Empuja el texto hacia la izquierda */
            margin-left: center; /* Empuja el texto hacia la derecha */
        }
        .navbar-brand img {
            height: 130px; /* Ajusta la altura de la imagen según tus necesidades */
        }
        .navbar-nav {
            display: flex;
            justify-content: center; /* Centra horizontalmente las opciones de menú */
            align-items: center; /* Centra verticalmente las opciones de menú */
            margin: 0; /* Elimina el margen para alinear correctamente */
            padding: 0; /* Elimina el relleno para alinear correctamente */
        }
        .nav-item {
            margin-left: 10px; /* Ajusta el espacio entre las opciones de menú */
        }
        .nav-link {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
        }
        .nav-link:hover {
            color: #ccc;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <a href="index.php"> <!-- Agregamos el enlace al logo -->
                <img src="/images/ledetech.png" alt="Logo">
            </a>
        </div>
        <div class="navbar-brand">
            Edición de Carro
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="alta_carros.php">Agregar Carro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listado_carros.php">Listado de Carros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listado_servicios.php">Listado de Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="alta_servicio.php">Agregar Servicio</a>
            </li>
        </ul>
    </nav>
    <div class="content">
    <div class="container mt-5">
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
            <a href="listado_carros.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
</body>
</html>

