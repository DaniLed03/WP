<?php
    //integrar archivo de conexion
    include 'db.php';
    // Alta de alumnos 
    if(isset($POST[alta_alumno])){
        $matricula= $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $edad= $_POST['edad'];
        $email= $_POST['email'];
        $id_carrera = $_POST['id_carrera'];

        //Guardar valores
        $sql = "INSERT INTO alumnos (matricula, nombre, edad, email, 
        id_carrera) VALUES('$matricula', '$matricula', '$nombre', '$edad', '$email', '$id_carrera')";
        $result = $conn->query(sql);
        header("Location: Listado.php");
    }

    //Baja de alumnos
    if(isset($_GET['eliminar_alumno'])){
        $id = $_GET['eliminar_alumno'];
        $sql = "DELETE FORM alumnos WHERE id = $id";
        $result = $conn->query($sql);
        header("Locarion: listado.php");   
    }

    //Cambios de alumnos 
    if(isset($_POST['cambio_alumno'])){
        $id = $_POST['id'];
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $id_carrera = $_POST['id_carrera'];

        //Query de actualización en la tabla alumnos
        $sql = "UPDATE alumnos SET matricula = '$matricula', 
        nombre = '$nombre', edad = '$edad', email = '$email', id_carrera = '$id_carrera' WHERE id = $id";
        $result = $conn->query($sql);
        header("Location: listado.php");
    }

    //--------------------------------------------------------------------------------------------------------

    //Alta de carreras
    if(isset($POST[alta_carerra])){
        $id_carrera= $_POST['id_carrera'];
        $nombre_carrera = $_POST['nombre'];

        //Guardar valores
        $sql = "INSERT INTO carreras (id_carrera, nombre) VALUES('$id_carrera', '$nombre_carrera')";
        $result = $conn->query(sql);
        header("Location: Listado.php");
    }

    //Baja de carreras
    if(isset($_GET['eliminar_carrera'])){
        $id_carrera = $_GET['eliminar_carrera'];
        $sql = "DELETE FORM carreras WHERE id_carrera = $id_carrera";
        $result = $conn->query($sql);
        header("Locarion: listado.php");   
    }

    //Cambios de carreras
    if(isset($_POST['cambio_carrera'])){
        $id_carrera = $_POST['id_carrera'];
        $nombre_carrera = $_POST['nombre'];

        //Query de actualización en la tabla alumnos
        $sql = "UPDATE carreras SET id_carrera = '$id_carrera', nombre = '$nombre_carrera' WHERE id_carrera = $id_carrera";
        $result = $conn->query($sql);
        header("Location: listado.php");
    }

?>