<?php
//Integramos el archivo de conexion a la bd
include 'db.php';
//Hacemoe la consulta para obtener todas las carreras
$sql = "SELECT alumnos.*, carrera.nombre AS nombre_carrera 
        FROM alumnos 
        INNER JOIN carrera ON alumnos.id_carrera = carrera.id_carrera";
$result = $conn->query($sql);

?>

<html lang="es">
    <head>
        <title>Listado de Alumnos</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <h2>Listado de Alumnos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Email</th>
                        <th>Carrera</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Recorrido en la tabla de carreras para obtener los registros
                    while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $row['matricula'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['edad'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['nombre_carrera'] ?></td>
                        <td>
                            <a href="editar_alumno.php?id=<?php echo $row['id']; ?>" 
                            class="btn btn-primary">Editar</a>

                            <form class="d-inlineblock" action="crud.php?eliminar_alumno=<?php echo $row['id']; ?>" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger" name="eliminar_alumno">Eliminar</button>
                            </form>
                        </td>   
                    </tr> 
                    <?php
                        endwhile; ?>
                </tbody>
            </table>
            <a href="alta_alumno.php" class="btn btn-primary">Agregar Alumno</a>
        </div>
    </body>
</html>