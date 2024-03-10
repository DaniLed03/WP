<?php
    include 'db.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM alumnos WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<html>
    <head>
        <title>Edicion de Alumno</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    </head>
    </body>
        <div class="container mt-5">
            <h2>Editar Alumno</h2>
            <form action="crud.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <div class="form-group>
                    <label for="matricula">Matricula: </label>
                    <input type="text" class="form-control" name="matricula"
                    value="<?php echo $row['matricula']; ?>" required>
                </div>

                <div class="form-group>
                    <label for="nombre">Nombre: </label>
                    <input type="text" class="form-control" name="nombre"
                    value="<?php echo $row['nombre']; ?>" required>
                </div>

                <div class="form-group>
                    <label for="edad">Edad: </label>
                    <input type="text" class="form-control" name="edad" 
                    value="<?php echo $row['edad']; ?>" required>
                </div>

                <div class="form-group>
                    <label for="email">Email: </label>
                    <input type="text" class="form-control" name="email" 
                    value="<?php echo $row['email']; ?>" required>
                </div>

                <div class="form-group>
                    <label for="id_carrera">Carrera: </label>
                    <select class="form-control" id="id_carrera" name="id_carrera" required>
                        <option value="">Selecciona una carrera</option>
                        <?php
                            include 'db.php';
                            //Consulta de id_carrera
                            $sql_carrera = "SELECT * FROM carrera";
                            $result_carrera = $conn->query($sql_carrera);
                            while ($row = $result_carrera->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row['id_carrera']; ?>"> 
                            <?php
                                ($row['id_carrera'] == $row['id_carrera']) ? 'selected' : '';
                            ?>
                            <?php echo $row['nombre']; ?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>       
                <br>     
                <button type="submit" class="btn btn-primary" name="cambio_alumno">Guardar Cambios</button>           
            </form>    
        </div>
    </body>
</html>