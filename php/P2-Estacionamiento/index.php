<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, #000000, #888888); /* Ruta de la imagen de fondo */
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center; /* Centra la imagen en la pantalla */
        }
        .content {
            width: 400px;
            text-align: center;
            padding: 20px;
            border: 2px solid rgba(255,255,255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 10px;
            background-color: transparent;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: white; /* Texto blanco */
        }
        .btn-purple {
            background-color: white; /* Fondo blanco para los botones */
            color: black; /* Letras negras */
            border-color: white; /* Color del borde igual al fondo */
            font-weight: bold; /* Letras en negrita */
        }
        .btn-purple:hover {
            background-color: #eeeeee; /* Color de fondo al pasar el mouse */
            color: black; /* Letras negras */
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 class="mb-4">Menú Principal</h1>
        <div class="list-group">
            <a href="alta_carros.php" class="btn btn-purple btn-lg btn-block mb-2">Agregar Carro</a>
            <a href="listado_carros.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Carros</a>
            <a href="listado_servicios.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Servicios</a>
            <a href="alta_servicio.php" class="btn btn-purple btn-lg btn-block mb-2">Agregar Servicio</a>
        </div> 
    </div>
</body>
</html>
