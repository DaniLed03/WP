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
        header("Location: listado_alumnos.php");
    }

    // Baja de alumnos
    if(isset($_GET['eliminar_alumno'])){
        $id = $_GET['eliminar_alumno'];

        // Eliminar las calificaciones del alumno
        $sql_delete_calificaciones = "DELETE FROM calificaciones WHERE id_alumno = $id";
        $result_delete_calificaciones = $conn->query($sql_delete_calificaciones);

        // Después de eliminar las calificaciones, puedes eliminar al alumno
        $sql_delete_alumno = "DELETE FROM alumnos WHERE id = $id";
        $result_delete_alumno = $conn->query($sql_delete_alumno);

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

        // Consultar si el alumno tiene calificaciones registradas para otra carrera
        $sql_calificaciones = "SELECT * FROM calificaciones 
                       INNER JOIN asignacion_materias_alumno 
                       ON calificaciones.id_materia = asignacion_materias_alumno.id_materia 
                       WHERE asignacion_materias_alumno.id_alumno = $id";

        $result_calificaciones = $conn->query($sql_calificaciones);

        // Si hay calificaciones, mostrar SweetAlert para confirmar la eliminación
        if ($result_calificaciones->num_rows > 0) {
            echo "<script>
                    if(confirm('Este alumno tiene calificaciones registradas para otra carrera. ¿Deseas borrarlas?')) {
                        window.location.href = 'eliminar_calificaciones.php?id=$id'; // Redirige para eliminar las calificaciones
                    } else {
                        window.location.href = 'editar_alumno.php?id=$id'; // Redirige de vuelta a la página de edición de alumno
                    }
                </script>";
            exit(); // Salir del script después de mostrar el SweetAlert
        }

        // Si no hay calificaciones, continuar con la actualización del alumno
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

    // Baja de carreras
    if(isset($_GET['eliminar_carrera'])){
        $id_carrera = $_GET['eliminar_carrera'];
        
        // Verificar si existen alumnos asociados a la carrera
        $sql_check_alumnos = "SELECT * FROM alumnos WHERE id_carrera = $id_carrera";
        $result_check_alumnos = $conn->query($sql_check_alumnos);
        
        if ($result_check_alumnos->num_rows > 0) {
            // Si hay alumnos asociados, establecer el mensaje de error en una variable JavaScript
            echo "<script>
                    alert('No se puede eliminar la carrera porque tiene alumnos registrados.');
                    window.location.href = 'listado_carreras.php';
                </script>";
            exit();
        } else {
            // Si no hay alumnos asociados, proceder con la eliminación de la carrera
            $sql = "DELETE FROM carrera WHERE id_carrera = $id_carrera";
            $result = $conn->query($sql);
            header("Location: listado_carreras.php");   
        }
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
    if(isset($_POST['eliminar_materia_alumno'])){
        $id_alumno = $_POST['id_alumno']; // Obtener el ID del alumno
        $id_materia = $_POST['id_materia']; // Obtener el ID de la materia a eliminar
        $sql = "DELETE FROM asignacion_materias_alumno WHERE id_materia = $id_materia AND id_alumno = $id_alumno";
        $result = $conn->query($sql);
        // Redirigir a listado_alumnos.php
        header("Location: listado_alumnos.php");
        exit();
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

    // Baja de materias de la carrera
    if(isset($_POST['eliminar_materia_carrera'])){
        $id_carrera = $_POST['id_carrera']; // Obtener el ID de la carrera
        $id_materia = $_POST['id_materia']; // Obtener el ID de la materia a eliminar

        // Verificar si hay alumnos asignados a esta materia en la tabla asignacion_materias_alumnos
        $sql_check_alumnos = "SELECT * FROM asignacion_materias_alumno WHERE id_materia = $id_materia";
        $result_check_alumnos = $conn->query($sql_check_alumnos);

        if ($result_check_alumnos->num_rows > 0) {
            // Si hay alumnos asignados, mostrar una alerta
            echo "<script>
                    if(confirm('No se puede eliminar esta materia porque actualmente hay alumnos inscritos a ella. ¿Deseas eliminar todas las asignaciones a esta materia?')) {
                        window.location.href = 'eliminar_asignaciones_materia.php?id_materia=$id_materia'; // Redirigir para eliminar las asignaciones
                    } else {
                        window.location.href = 'listado_carreras.php'; // Redirigir de vuelta a la lista de carreras
                    }
                </script>";
            exit(); // Salir del script después de mostrar la alerta
        } else {
            // Si no hay alumnos asignados, proceder con la eliminación de la asignación de la materia
            $sql_delete = "DELETE FROM asignacion_materias_carrera WHERE id_materia = $id_materia AND id_carrera = $id_carrera";
            $result_delete = $conn->query($sql_delete);
            // Redirigir de vuelta a la lista de carreras después de completar la eliminación
            header("Location: listado_carreras.php");
            exit();
        }
    }


    // Verifica si se recibieron los datos para guardar la asignación de materias
    if(isset($_POST['guardar_asignacion'])) {
        $id_alumno = $_POST['id_alumno'];
        $materias_asignadas = $_POST['materias_asignadas'];

        // Elimina las asignaciones anteriores del alumno
        $sql_delete = "DELETE FROM asignacion_materias_alumno WHERE id_alumno = $id_alumno";
        $conn->query($sql_delete);

        // Inserta las nuevas asignaciones de materias
        foreach($materias_asignadas as $materia_id) {
            $sql_insert = "INSERT INTO asignacion_materias_alumno (id_alumno, id_materia) VALUES ($id_alumno, $materia_id)";
            $conn->query($sql_insert);
        }

        // Redirige de vuelta a la página de listado de alumnos
        header("Location: listado_alumnos.php");
        exit();
    }

    //---------------------------------------------------------------------------------------------------------

    // Verifica si se envió el formulario de asignación de materias a la carrera
    if(isset($_POST['asignar_materias_carrera'])) {
        // Verifica si se proporcionó el ID de la carrera
        if(isset($_POST['id_carrera'])) {
            $id_carrera = $_POST['id_carrera'];
            
            // Verifica si se seleccionaron materias para asignar
            if(isset($_POST['materias_asignadas']) && is_array($_POST['materias_asignadas'])) {
                // Procesa la asignación de materias a la carrera
                foreach($_POST['materias_asignadas'] as $id_materia) {
                    // Inserta los datos en la tabla de asignación de materias a la carrera
                    $sql_insert = "INSERT INTO asignacion_materias_carrera (id_carrera, id_materia) VALUES ('$id_carrera', '$id_materia')";
                    if ($conn->query($sql_insert) === TRUE) {
                        echo "Materia asignada correctamente a la carrera.";
                    } else {
                        echo "Error al asignar materia a la carrera: " . $conn->error;
                    }
                }
                // Redirige de vuelta a listado_carreras.php después de completar la asignación
                header("Location: listado_carreras.php");
                exit();
            } else {
                // Si no se seleccionaron materias, muestra un mensaje de error o realiza alguna acción adecuada
                echo "No se seleccionaron materias para asignar.";
            }
        } else {
            // Si no se proporcionó el ID de la carrera, muestra un mensaje de error o realiza alguna acción adecuada
            echo "No se proporcionó el ID de la carrera.";
        }
    }
    
?>