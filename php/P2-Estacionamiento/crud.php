<?php
    include 'db.php';

    // Alta de alumnos 
    if(isset($_POST['alta_carro'])){
        $no_Serie = $_POST['no_serie'];
        $marca = $_POST['marca'];
        $submarca = $_POST['submarca'];
        $tipo = $_POST['tipo'];
        $modelo = $_POST['modelo'];
        $color = $_POST['color'];
        $capacidad = $_POST['capacidad'];
        $año = $_POST['año'];
        $no_serie = $_POST['no_serie'];
        $procedencia = $_POST['procedencia'];  

        $sql = "INSERT INTO carros (no_serie, marca, submarca, tipo, modelo, color, capacidad, año, procedencia) 
                VALUES ('$no_serie', '$marca', '$submarca', '$tipo', '$modelo', '$color', '$capacidad', '$año', '$procedencia')";
        $result = $conn->query($sql);
        header("Location: listado_carros.php");    
    }

    // Baja de carros
    if(isset($_GET['eliminar_carro'])){
        $id_carro = $_GET['eliminar_carro'];

        // Eliminar carro
        $sql_eliminar_carros = "DELETE FROM carros WHERE id_carro = $id_carro";
        $result_eliminar_carros = $conn->query($sql_eliminar_carros);

        header("Location: listado_carros.php");   
    }

    //Cambios de carros 
    if(isset($_POST['cambio_carro'])){
        $id_carro = $_POST['id_carro'];
        $no_serie = $_POST['no_serie'];
        $marca = $_POST['marca'];
        $submarca = $_POST['submarca'];
        $tipo = $_POST['tipo'];
        $modelo = $_POST['modelo'];
        $color = $_POST['color'];
        $capacidad = $_POST['capacidad'];
        $año = $_POST['año'];
        $procedencia = $_POST['procedencia'];

        //Query de actualización en la tabla carros
        $sql = "UPDATE carros SET no_serie = '$no_serie', 
        marca = '$marca', submarca = '$submarca', tipo = '$tipo', modelo = '$modelo', color = '$color', capacidad = '$capacidad', año = '$año', procedencia = '$procedencia' WHERE id_carro = $id_carro";
        $result = $conn->query($sql);
        header("Location: listado_carros.php");
    }

?>

