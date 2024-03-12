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
            background-color: #f8f9fa;
        }
        .content {
            width: 400px;
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-purple {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }
        .btn-purple:hover {
            background-color: #553982;
            border-color: #553982;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 class="mb-4">Menú Principal</h1>
        <div class="list-group">
            <a href="alta_carros.php" class="btn btn-purple btn-lg btn-block mb-2">Agregar Carro</a>
            <a href="listado_carros.php" class="btn btn-purple btn-lg btn-block mb-2">Listado de Carros</a>
        </div> 
    </div>
</body>
</html>
