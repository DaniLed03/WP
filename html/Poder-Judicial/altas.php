<?php
require_once 'db.php';

// Consulta para obtener los valores del Tipo de Asunto
$query = "SELECT TIPOASUNTO FROM cat_tipoasunto"; // Modifica aquí el nombre de la tabla si es necesario

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
    echo "Error: " . $conn->error;
}

// Consulta para obtener los valores del Tipo de Cuaderno desde la tabla cat_tipocuaderno
$query_cuaderno = "SELECT TIPOCUADERNO FROM cat_tipocuaderno"; // Modifica aquí el nombre de la tabla si es necesario

$result_cuaderno = $conn->query($query_cuaderno);

// Verificar si la consulta fue exitosa
if ($result_cuaderno) {
    // Generar las opciones del select con los valores obtenidos de la consulta
    $options_cuaderno = '';
    while ($row_cuaderno = $result_cuaderno->fetch_assoc()) {
        $options_cuaderno .= '<option value="' . $row_cuaderno['TIPOCUADERNO'] . '">' . $row_cuaderno['TIPOCUADERNO'] . '</option>';
    }
} else {
    // Mostrar un mensaje de error en caso de fallo en la consulta
    echo "Error: " . $conn->error;
}

// Consulta para obtener los valores de valoración desde la tabla cat_valoracion
$query_valoracion = "SELECT VALORACION FROM cat_valoracion"; // Modifica aquí el nombre de la tabla si es necesario

$result_valoracion = $conn->query($query_valoracion);

// Verificar si la consulta fue exitosa
if ($result_valoracion) {
    // Generar las opciones del select con los valores obtenidos de la consulta
    $options_valoracion = '';
    while ($row_valoracion = $result_valoracion->fetch_assoc()) {
        $options_valoracion .= '<option value="' . $row_valoracion['VALORACION'] . '">' . $row_valoracion['VALORACION'] . '</option>';
    }
} else {
    // Mostrar un mensaje de error en caso de fallo en la consulta
    echo "Error: " . $conn->error;
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

        .custom-btn {
            background-color: #940202;
            border-color: #940202;
            color: #ffffff;
        }

        .custom-btn:hover {
            background-color: #740202;
            border-color: #740202;
        }
        .custom-btn:disabled {
            background-color: #CCCCCC; /* Gris */
            border-color: #CCCCCC;
            cursor: not-allowed; /* Cursor de no permitido */
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
                    <input type="text" class="form-control" id="no_expediente" name="no_expediente" placeholder="00/0000" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="expediente" readonly>Expediente:</label>
                    <input type="text" class="form-control" id="expediente" name="expediente" readonly required>
                </div>
                <div class="form-group col-md-3">
                    <label for="anio" readonly>Año:</label>
                    <input type="number" class="form-control" id="anio" name="anio" readonly required>
                </div>
            </div>
            <div class="titulo-expediente mt-4">Quejoso/Autoridad Responsable/Procesado</div>
            <!------------------------------------------------------------------------------------------------>
            <div class="form-row">
                <div class="form-group col-md-12"> <!-- Cambiado a col-md-6 para que ocupe la mitad del ancho -->
                    <label for="persona" readonly>Nombre:</label>
                    <input type="text" class="form-control" id="persona" name="persona" readonly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9"> <!-- Cambiado a col-md-6 para que ocupe la mitad del ancho -->
                    <label for="secretario" readonly>Secretario:</label>
                    <input type="text" class="form-control" id="secretario" name="secretario" readonly required>
                </div>
                <div class="form-group col-md-3"> <!-- Cambiado a col-md-6 para que ocupe la mitad del ancho -->
                    <label for="mesa" readonly>Mesa:</label>
                    <input type="text" class="form-control" id="mesa" name="mesa" readonly required>
                </div>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones:</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="5" readonly required></textarea>
            </div>

            <button type="submit" class="btn btn-primary custom-btn" disabled>Guardar</button>
            <button type="button" class="btn btn-primary custom-btn">Buscar</button>
            <button type="button" class="btn btn-secondary custom-btn" disabled>Limpiar</button>
            <button type="button" class="btn btn-warning custom-btn" disabled>Editar</button>
            <button type="button" class="btn btn-danger custom-btn" disabled>Cancelar</button>
            <button type="button" class="btn btn-danger custom-btn" disabled>Eliminar</button>
            <!------------------------------------------------------------------------------------------------>
            <div class="titulo-expediente mt-4">Cuaderno</div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="id_tipocuaderno">Tipo de Cuaderno:</label>
                    <select class="form-control" id="id_tipocuaderno" name="id_tipocuaderno" required disabled>
                        <!-- Mostrar las opciones generadas desde PHP -->
                        <?php echo $options_cuaderno; ?>
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <label for="cant_tomos">Tomos:</label>
                    <input type="number" class="form-control" id="cant_tomos" name="cant_tomos" required readonly>
                </div>
                <div class="form-group col-md-1">
                    <label for="cant_anexos">Anexos:</label>
                    <input type="number" class="form-control" id="cant_anexos" name="cant_anexos" required readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha_ingreso">Fecha de Ingreso:</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha_archivo">Fecha de Archivo:</label>
                    <input type="date" class="form-control" id="fecha_archivo" name="fecha_archivo" required readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha_remision">Fecha de Remisión:</label>
                    <input type="date" class="form-control" id="fecha_remision" name="fecha_remision" required readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha_recepcion">Fecha de Recepción:</label>
                    <input type="date" class="form-control" id="fecha_recepcion" name="fecha_recepcion" required readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="id_valoracion">Valoración:</label>
                    <select class="form-control" id="id_valoracion" name="id_valoracion" required disabled>
                        <!-- Mostrar las opciones generadas desde PHP -->
                        <?php echo $options_valoracion; ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha_acta">Fecha del Acta:</label>
                    <input type="date" class="form-control" id="fecha_acta" name="fecha_acta" required readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="observaciones_cuaderno">Observaciones:</label>
                <textarea class="form-control" id="observaciones_cuaderno" name="observaciones_cuaderno" rows="5" required readonly></textarea>
            </div>

            <button type="submit" class="btn btn-primary custom-btn" disabled>Agregar</button>
            <button type="button" class="btn btn-primary custom-btn" disabled>Guardar</button>
            <button type="button" class="btn btn-secondary custom-btn" disabled>Eliminar</button>
            <button type="button" class="btn btn-warning custom-btn" disabled>Cancelar</button>
        </form>
    </div>
    <br>

    <!-- Enlaces a los archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
