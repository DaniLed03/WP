<?php
include 'db.php'; // Incluye el archivo db.php para establecer la conexión

$sql_materias = "SELECT * FROM materias";
$result_materias = $conn->query($sql_materias);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Materias a Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Asignar Materias a Alumno</h1>
        <form action="crud.php" method="POST">
            <input type="hidden" name="id_alumno" value="<?php echo $_GET['id_alumno']; ?>">
            <div class="form-group">
                <label>Materias Disponibles:</label>
                <?php 
                include 'db.php'; // Incluye el archivo db.php para establecer la conexión

                $sql_materias = "SELECT * FROM materias";
                $result_materias = $conn->query($sql_materias);

                if ($result_materias->num_rows > 0) {
                    $count = 0;
                    while($row_materia = $result_materias->fetch_assoc()): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="materias_asignadas[]" value="<?php echo $row_materia['id_materia']; ?>" onchange="limitarSeleccion(this)">
                            <label class="form-check-label">
                                <?php echo $row_materia['nombre']; ?>
                            </label>
                        </div>
                    <?php 
                    $count++;
                    endwhile;
                } else {
                    echo "No hay materias disponibles.";
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary" name="asignar_materias">Asignar Materias</button>
        </form>
    </div>

    <script>
        function limitarSeleccion(checkbox) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var checkedCount = 0;
            checkboxes.forEach(function(box) {
                if (box.checked) {
                    checkedCount++;
                }
            });
            if (checkedCount > 7) {
                checkbox.checked = false;
                alert("Solo puedes seleccionar hasta 7 materias.");
            }
        }
    </script>
</body>
</html>
