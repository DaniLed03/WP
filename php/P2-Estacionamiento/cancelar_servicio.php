<?php
include 'db.php';

if(isset($_GET['id_servicio']) && isset($_GET['id_carro'])){
    $id_servicio = $_GET['id_servicio'];
    $id_carro = $_GET['id_carro'];

    // Consulta para eliminar el servicio de la tabla entrada_servicios, asegurando que coincida con el id_carro
    $sql = "DELETE FROM entrada_servicios WHERE id_servicio = $id_servicio AND id_carro = $id_carro";
    $result = $conn->query($sql);

    if($result){
        // Redireccionar de nuevo a la página de servicios pendientes
        header("Location: ver_servicios.php?id_carro=$id_carro");
        exit();
    } else {
        echo "Error al cancelar el servicio";
    }
}
?>
