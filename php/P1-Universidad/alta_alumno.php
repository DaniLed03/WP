<!DOCTYPE html>
<html>
<head>
    <title>Alta de Estudiantes</title>
    <!-- Agregar el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos para el menú lateral */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #6a0dad; /* Morado */
            padding-top: 20px;
            text-align: center; /* Centrar el texto */
        }

        .sidebar h3 {
            color: #fff; /* Blanco */
            font-weight: bold; /* Negrita */
            margin-bottom: 20px; /* Espacio inferior */
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            color: #fff; /* Blanco */
        }

        .sidebar a:hover {
            background-color: #8a56ac; /* Morado más claro */
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Menú lateral -->
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

<!-- Contenido principal -->
<div class="content">
    <div class="container mt-5">
        <h2>Alta de Estudiantes</h2>
        <!-- Formulario para agregar estudiantes -->
        <form action="crud.php" method="POST">
            <div class="form-group">
                <label for="matricula">Matricula: </label>
                <input type="text" class="form-control" name="matricula" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre: </label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad: </label>
                <input type="text" class="form-control" name="edad" required>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="id_carrera">Carrera: </label>
                <!-- Selector para elegir la carrera del estudiante -->
                <select class="form-control" id="id_carrera" name="id_carrera" required>
                    <option value="">Selecciona una carrera</option>
                    <?php
                        include 'db.php';
                        //Consulta de id_carrera
                        $sql_carrera = "SELECT * FROM carrera";
                        $result_carrera = $conn->query($sql_carrera);
                        while ($row = $result_carrera->fetch_assoc()){
                    ?>
                    <option value="<?php echo $row['id_carrera']; ?>"> <?php echo $row['nombre']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <br>
            <!-- Botón para agregar estudiante -->
            <button type="submit" class="btn btn-primary" name="alta_alumno">Agregar Estudiante</button>
        </form>
    </div>
</div>

</body>
</html>
