<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Carros</title>
    <!-- Incluye el archivo CSS de Bootstrap -->
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
        /* Estilos para la fuente Comic Sans MS */
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
        <!-- Logo -->
        <div class="navbar-brand">
            <!-- Enlace que lleva a la página de inicio -->
            <a href="index.php">
                <!-- Texto "LedeTaller" con estilo personalizado -->
                <span class="font-comic custom-size">LedeTaller</span>
            </a>
        </div>
        <!-- Título de la página actual -->
        <div class="navbar-brand">
            Registro de Carros
        </div>
        <!-- Lista de enlaces de navegación -->
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
            <!-- Formulario de alta de carros -->
            <form action="crud.php" method="POST">
                <div class="form-group">
                    <label for="no_serie">No. de Serie:</label>
                    <input type="Number" class="form-control" id="no_serie" name="no_serie" required>
                </div>
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                </div>
                <div class="form-group">
                    <label for="submarca">Submarca:</label>
                    <input type="text" class="form-control" id="submarca" name="submarca" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" required>
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color" required>
                </div>
                <div class="form-group">
                    <label for="capacidad">Capacidad:</label>
                    <input type="text" class="form-control" id="capacidad" name="capacidad" required>
                </div>
                <div class="form-group">
                    <label for="año">Año:</label>
                    <input type="Number" class="form-control" id="año" name="año" required>
                </div>
                <div class="form-group">
                    <label for="procedencia">Procedencia:</label>
                    <input type="text" class="form-control" id="procedencia" name="procedencia" required>
                </div>
                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn btn-primary" name="alta_carro">Agregar Carro</button>
                <!-- Enlace para cancelar y regresar al listado de carros -->
                <a href="listado_carros.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>
<html>
