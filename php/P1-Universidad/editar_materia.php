<?php
include 'db.php';

$id_materia = $_GET['id_materia'];
$sql = "SELECT * FROM materias WHERE id_materia = $id_materia";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos para el menú lateral */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #6a0dad; /* Cambio de color a morado */
            padding-top: 20px;
            text-align: center; /* Centrar el texto */
        }

        .sidebar h3 {
            color: #fff; /* Cambio de color de texto a blanco */
            font-weight: bold; /* Texto en negritas */
            margin-bottom: 20px; /* Espacio inferior */
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            color: #fff; /* Cambio de color de texto a blanco */
        }

        .sidebar a:hover {
            background-color: #8a56ac; /* Cambio de color de fondo al hacer hover */
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
    <a href="index.php" style="color: #fff;">Inicio</a> <!-- Agregar enlace para volver al menú principal -->
    <a href="listado_alumnos.php">Listado de Alumnos</a>
    <a href="alta_alumno.php">Agregar Alumno</a>
    <a href="listado_carreras.php">Listado de Carreras</a>
    <a href="alta_carrera.php">Agregar Carrera</a>
    <a href="listado_materias.php">Listado de Materias</a>
    <a href="alta_materia.php">Agregar Materia</a>
</div>

<div class="content">
    <div class="container mt-5">
        <h2>Editar Materia</h2>
        <?php
        include 'db.php';

        $id_materia = $_GET['id_materia'];
        $sql = "SELECT * FROM materias WHERE id_materia = $id_materia";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <form action="crud.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id_materia']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="cambio_materia">Guardar Cambios</button>
        </form>
    </div>
</div>

</body>
</html>

