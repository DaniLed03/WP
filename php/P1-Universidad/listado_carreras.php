<?php
//Integramos el archivo de conexion a la bd
include 'db.php';
//Hacemoe la consulta para obtener todas las carreras
$sql = "SELECT * FROM carrera";
$result = $conn->query($sql);

?>

<html lang="es">
    <head>
        <title>Listado de Carreras</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <h2>Listado de Carreras</h2>
            <!-- <a href="alta_carreras.php" class="btn btn-primary">Agregar Carrera</a>-->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Carrera</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Recorrido en la tabla de carreras para obtener los registros
                    while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['id_carrera'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td>
                            <a href="editar_carrera.php?id_carrera=<?php $row['id_carrera']; ?>" class="btn btn-primary">Editar</a>
                            <form class="d-inline" action="crud.php?eliminar_carrera=<?php $row ['id_carrera']?>" method="POST">
                                <input type="hidden" name="id_carrera" value="<?php echo $row['id_carrera'];?>">
                                <button type="submit" class="btn btn-danger" name="eliminar_carrera">Eliminar</button>
                            </form>
                        </td>   
                    </tr> 
                    <?php
                        } ?>
                </tbody>
            </table>
            <a href="alta_carrera.php" class="btn btn-success">Agregar Carrera</a>
        </div>
    </body>
</html>