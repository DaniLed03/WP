<html>
    <head>
        <title> Alta de Carreras </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    </head>
    <body>
        <div class="container mt-5">
            <h2> Alta de Carreras </h2>
            <form action="crud.php" method="POST">
                <div class="form-group>
                    <label for="$nombre_carrera"> Nombre de carrera </label>
                    <input type="text" class="form-control" name="nombre_carrera" required>
                </div>
                <button 
                    type="submit" class="btn btn-primary" name="alta_carrera"> Agregar carrera </button>
                </button>
            </form>
    </body>
</html>