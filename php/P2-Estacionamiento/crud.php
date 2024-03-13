<?php
    include 'db.php';

    // Alta de alumnos 
    if(isset($_POST['alta_carro'])){
        $no_serie = $_POST['no_serie'];
        
        // Verificar si el número de serie ya existe en la base de datos
        $sql_verificacion = "SELECT COUNT(*) AS total FROM carros WHERE no_serie = '$no_serie'";
        $result_verificacion = $conn->query($sql_verificacion);
        $row_verificacion = $result_verificacion->fetch_assoc();
        
        if($row_verificacion['total'] > 0){
            // Si el número de serie ya existe, mostrar una alerta
            echo "<script>
                    alert('El número de serie ya existe en la base de datos');
                    window.location.href='alta_carros.php';
                </script>";
        } else {
            // Si el número de serie no existe, proceder con la inserción
            $marca = $_POST['marca'];
            $submarca = $_POST['submarca'];
            $tipo = $_POST['tipo'];
            $modelo = $_POST['modelo'];
            $color = $_POST['color'];
            $capacidad = $_POST['capacidad'];
            $año = $_POST['año'];
            $procedencia = $_POST['procedencia'];  

            $sql = "INSERT INTO carros (no_serie, marca, submarca, tipo, modelo, color, capacidad, año, procedencia) 
                    VALUES ('$no_serie', '$marca', '$submarca', '$tipo', '$modelo', '$color', '$capacidad', '$año', '$procedencia')";
            $result = $conn->query($sql);
            header("Location: listado_carros.php");  
        }  
    }

    // Baja de carros
    if(isset($_GET['eliminar_carro'])){
        $id_carro = $_GET['eliminar_carro'];

        // Verificar si hay servicios asociados a este carro
        $sql_verificar_servicios = "SELECT COUNT(*) AS total_servicios FROM entrada_servicios WHERE id_carro = $id_carro";
        $result_verificar_servicios = $conn->query($sql_verificar_servicios);
        $row_verificar_servicios = $result_verificar_servicios->fetch_assoc();

        if($row_verificar_servicios['total_servicios'] > 0){
            // Si hay servicios asociados, mostrar una alerta y no permitir la eliminación
            echo "<script>
                    alert('No se puede eliminar el carro porque tiene servicios asociados.');
                    window.location.href='listado_carros.php';
                </script>";
        } else {
            // Si no hay servicios asociados, proceder con la eliminación del carro
            $sql_eliminar_carros = "DELETE FROM carros WHERE id_carro = $id_carro";
            $result_eliminar_carros = $conn->query($sql_eliminar_carros);

            header("Location: listado_carros.php");
        }
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

