<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Consulta para obtener los valores del Tipo de Asunto
$query = "SELECT TIPOASUNTO FROM CAT_TIPOASUNTO";
$result = $conn->query($query);

// Verificar si la consulta fue exitosa
if ($result) {
    // Generar las opciones del select con los valores obtenidos de la consulta
    $options = '';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['TIPOASUNTO'] . '">' . $row['TIPOASUNTO'] . '</option>';
    }
} else {
    // Mostrar un mensaje de error en caso de fallo en la consulta
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Alta de Expedientes</title>
    <!-- Enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .titulo-expediente {
            font-size: 24px;
            font-weight: bold;
            text-align: left;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Datos del Expediente</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="id_tipoasunto">ID Tipo de Asunto:</label>
                    <select class="form-control" id="id_tipoasunto" name="id_tipoasunto" required>
                        <!-- Mostrar las opciones generadas desde PHP -->
                        <?php echo $options; ?>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="no_expediente">No. Expediente:</label>
                    <input type="text" class="form-control" id="no_expediente" name="no_expediente" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="expediente">Expediente:</label>
                    <input type="text" class="form-control" id="expediente" name="expediente" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="anio">Año:</label>
                    <input type="number" class="form-control" id="anio" name="anio" required>
                </div>
            </div>
            
            <div class="titulo-expediente mt-4">Otros Datos</div>
            <div class="form-group">
                <label for="num_orden">Núm. de Orden:</label>
                <input type="text" class="form-control" id="num_orden" name="num_orden" required>
            </div>
            <div class="form-group">
                <label for="persona">Persona:</label>
                <input type="text" class="form-control" id="persona" name="persona" required>
            </div>
            <div class="form-group">
                <label for="mesa">Mesa:</label>
                <input type="text" class="form-control" id="mesa" name="mesa" required>
            </div>
            <div class="form-group">
                <label for="secretario">Secretario:</label>
                <input type="text" class="form-control" id="secretario" name="secretario" required>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones:</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <!-- Enlaces a los archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
