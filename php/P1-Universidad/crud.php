<?php
    //integrar archivo de conexion
    include 'db.php';
    // Alta de alumnos 
    if(isset($_POST['alta_alumno'])){
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $id_carrera = $_POST['id_carrera'];
    
        $sql = "INSERT INTO alumnos (matricula, nombre, edad, email, id_carrera) 
                VALUES ('$matricula', '$nombre', '$edad', '$email', '$id_carrera')";
        $result = $conn->query($sql);
        // Redirect back to listado_alumno.php
        header("Location: listado_alumnos.php");
    }

    //Baja de alumnos
    if(isset($_GET['eliminar_alumno'])){
        $id = $_GET['eliminar_alumno'];
        $sql = "DELETE FROM alumnos WHERE id = $id";
        $result = $conn->query($sql);
        header("Location: listado_alumnos.php");   
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
        header("Location: listado_alumnos.php");
    }

    //--------------------------------------------------------------------------------------------------------

    //Alta de carreras
    if(isset($_POST['alta_carrera'])){
        $nombre = $_POST['nombre'];
    
        //Guardar valores
        $sql = "INSERT INTO carrera (nombre) VALUES('$nombre')";
        $result = $conn->query($sql);
        header("Location: listado_carreras.php");
    }

    //Baja de carreras
    if(isset($_GET['eliminar_carrera'])){
        $id_carrera = $_GET['eliminar_carrera'];
        $sql = "DELETE FROM carrera WHERE id_carrera = $id_carrera";
        $result = $conn->query($sql);
        header("Location: listado_carreras.php");   
    }

    //Cambios de carreras
    if(isset($_POST['cambio_carrera'])){
        $id_carrera = $_POST['id_carrera'];
        $nombre_carrera = $_POST['nombre_carrera'];

        //Query de actualización en la tabla alumnos
        $sql = "UPDATE carrera SET id_carrera = '$id_carrera', nombre = '$nombre_carrera' WHERE id_carrera = $id_carrera";
        $result = $conn->query($sql);
        header("Location: listado_carreras.php");
    }

    //--------------------------------------------------------------------------------------------------------

    // Alta de materias
    if(isset($_POST['alta_materia'])){
        $nombre = $_POST['nombre'];

        $sql = "INSERT INTO materias (nombre) VALUES ('$nombre')";
        $result = $conn->query($sql);
        header("Location: listado_materias.php");
    }

    // Baja de materias
    if(isset($_GET['eliminar_materia'])){
        $id = $_GET['eliminar_materia'];
        $sql = "DELETE FROM materias WHERE id_materia = $id";
        $result = $conn->query($sql);
        header("Location: listado_materias.php");   
    }

    // Cambios de materias
    if(isset($_POST['cambio_materia'])){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];

        $sql = "UPDATE materias SET nombre = '$nombre' WHERE id_materia = $id";
        $result = $conn->query($sql);
        header("Location: listado_materias.php");
    }

    //--------------------------------------------------------------------------------------------------------

    // Alta de asignación de materias a alumnos
    if(isset($_POST['asignar_materias'])){
        $id_alumno = $_POST['id_alumno'];
        $materias_asignadas = $_POST['materias_asignadas'];

        $sql = "UPDATE alumnos SET materias_asignadas = '$materias_asignadas' WHERE id = $id_alumno";
        $result = $conn->query($sql);
        header("Location: listado_alumnos.php");
    }

?>