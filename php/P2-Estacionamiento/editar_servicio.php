<?php
include 'db.php';

// Verificar si se ha enviado el formulario de edición
if(isset($_POST['editar_servicio'])){
    $id_servicio = $_POST['id_servicio'];
    $nombre = $_POST['nombre'];
    $costo = $_POST['costo'];

    // Actualizar los datos del servicio en la base de datos
    $sql = "UPDATE servicios SET nombre='$nombre', costo='$costo' WHERE id_servicio=$id_servicio";
    $result = $conn->query($sql);
    header("Location: listado_servicios.php"); // Redirigir al listado de servicios después de la actualización
}

// Obtener el ID del servicio de la URL
$id_servicio = $_GET['id_servicio'];

// Consultar la información del servicio específico
$sql = "SELECT * FROM servicios WHERE id_servicio=$id_servicio";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de Servicio</title>
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
                <img src="images/ledetech.png" alt="Logo">
            </a>
        </div>
        <div class="navbar-brand">
            Edición de Servicio
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
            <form action="editar_servicio.php" method="POST">
                <input type="hidden" name="id_servicio" value="<?php echo $row['id_servicio']; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre del Servicio:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="costo">Costo:</label>
                    <input type="text" class="form-control" id="costo" name="costo" value="<?php echo $row['costo']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="editar_servicio">Guardar Cambios</button>
                <a href="listado_servicios.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>

