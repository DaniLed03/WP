<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';

// Verificar si se ha enviado el formulario de alta de servicio
if(isset($_POST['alta_servicio'])){
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $costo = $_POST['costo'];

    // Crear la consulta SQL para insertar el servicio en la base de datos
    $sql = "INSERT INTO servicios (nombre, costo) VALUES ('$nombre', '$costo')";
    
    // Ejecutar la consulta
    $result = $conn->query($sql);
    
    // Redirigir al usuario a la página de listado de servicios después de agregar el servicio
    header("Location: listado_servicios.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Servicio</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
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
        .font-comic {
            font-family: 'Comic Sans MS', cursive;
            color: white; /* Color blanco */
        }
        .custom-size {
            font-size: 50px; /* Puedes ajustar el tamaño según tus preferencias */
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar">
        <!-- Marca de navegación -->
        <div class="navbar-brand">
            <!-- Enlace al inicio -->
            <a href="index.php">
                <!-- Texto "LedeTaller" -->
                <span class="font-comic custom-size">LedeTaller</span>
            </a>
        </div>
        <!-- Texto "Registro de Servicios" -->
        <div class="navbar-brand">
            Registro de Servicios
        </div>
        <!-- Lista de opciones de navegación -->
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

    <!-- Contenido principal -->
    <div class="content">
        <div class="container mt-5">
            <!-- Formulario de alta de servicio -->
            <form action="alta_servicio.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre del Servicio:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="costo">Costo:</label>
                    <input type="text" class="form-control" id="costo" name="costo" required>
                </div>
                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn btn-primary" name="alta_servicio">Agregar Servicio</button>
                <!-- Enlace para cancelar y volver a la lista de servicios -->
                <a href="listado_servicios.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
