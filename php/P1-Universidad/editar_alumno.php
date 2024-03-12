<?php
    // Incluye el archivo de conexión a la base de datos
    include 'db.php';

    // Obtiene el ID del alumno desde la URL
    $id = $_GET['id'];

    // Consulta SQL para seleccionar los datos del alumno con el ID especificado
    $sql = "SELECT * FROM alumnos WHERE id = $id";

    // Ejecuta la consulta SQL
    $result = $conn->query($sql);

    // Obtiene la fila del resultado como un array asociativo
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de Alumno</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos para el menú lateral */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #6a0dad; /* Color morado */
            padding-top: 20px;
            text-align: center; /* Centrar el texto */
        }

        .sidebar h3 {
            color: #fff; /* Color blanco */
            font-weight: bold; /* Texto en negritas */
            margin-bottom: 20px; /* Espacio inferior */
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            color: #fff; /* Color blanco */
        }

        .sidebar a:hover {
            background-color: #8a56ac; /* Color de fondo al hacer hover */
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Menú Principal</h3>
    <a href="index.php" style="color: #fff;">Inicio</a> <!-- Enlace para volver al menú principal -->
    <a href="listado_alumnos.php">Listado de Alumnos</a>
    <a href="alta_alumno.php">Agregar Alumno</a>
    <a href="listado_carreras.php">Listado de Carreras</a>
    <a href="alta_carrera.php">Agregar Carrera</a>
    <a href="listado_materias.php">Listado de Materias</a>
    <a href="alta_materia.php">Agregar Materia</a>
</div>

<div class="content">
    <div class="container mt-5">
        <h2>Editar Alumno</h2>
        <form action="crud.php" method="POST">
            <!-- Campo oculto para enviar el ID del alumno -->
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <!-- Campo de entrada para la matrícula del alumno -->
            <div class="form-group">
                <label for="matricula">Matricula: </label>
                <input type="text" class="form-control" name="matricula" value="<?php echo $row['matricula']; ?>" required>
            </div>

            <!-- Campo de entrada para el nombre del alumno -->
            <div class="form-group">
                <label for="nombre">Nombre: </label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre']; ?>" required>
            </div>

            <!-- Campo de entrada para la edad del alumno -->
            <div class="form-group">
                <label for="edad">Edad: </label>
                <input type="text" class="form-control" name="edad" value="<?php echo $row['edad']; ?>" required>
            </div>

            <!-- Campo de entrada para el email del alumno -->
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
            </div>

            <!-- Selector para la carrera del alumno -->
            <div class="form-group">
                <label for="id_carrera">Carrera: </label>
                <select class="form-control" id="id_carrera" name="id_carrera" required>
                    <option value="">Selecciona una carrera</option>
                    <?php
                        // Consulta SQL para obtener las carreras
                        $sql_carrera = "SELECT * FROM carrera";
                        // Ejecuta la consulta SQL
                        $result_carrera = $conn->query($sql_carrera);
                        // Itera sobre los resultados y crea las opciones del selector
                        while ($row = $result_carrera->fetch_assoc()){
                    ?>
                    <option value="<?php echo $row['id_carrera']; ?>"> 
                        <?php
                            ($row['id_carrera'] == $row['id_carrera']) ? 'selected' : ''; // Selecciona la opción si coincide con la carrera del alumno
                        ?>
                        <?php echo $row['nombre']; ?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
            </div>       
            <br>     
            <!-- Botón para guardar los cambios -->
            <button type="submit" class="btn btn-primary" name="cambio_alumno">Guardar Cambios</button>           
        </form>    
    </div>
</div>

</body>
</html>