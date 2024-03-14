<?php
// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Verifica si se han recibido los parámetros 'id_servicio' y 'id_carro' mediante GET
if(isset($_GET['id_servicio']) && isset($_GET['id_carro'])){
    // Asigna los valores recibidos a variables
    $id_servicio = $_GET['id_servicio'];
    $id_carro = $_GET['id_carro'];

    // Consulta SQL para eliminar el servicio de la tabla entrada_servicios,
    // asegurando que coincida con el id_servicio y el id_carro proporcionados
    $sql = "DELETE FROM entrada_servicios WHERE id_servicio = $id_servicio AND id_carro = $id_carro";
    $result = $conn->query($sql); // Ejecuta la consulta en la base de datos

    // Verifica si la consulta se ejecutó correctamente
    if($result){
        // Si la consulta se ejecutó con éxito, redirecciona a la página de servicios pendientes
        header("Location: ver_servicios.php?id_carro=$id_carro");
        exit(); // Termina la ejecución del script
    } else {
        // Si ocurrió un error durante la eliminación del servicio, muestra un mensaje de error
        echo "Error al cancelar el servicio";
    }
}
?>
