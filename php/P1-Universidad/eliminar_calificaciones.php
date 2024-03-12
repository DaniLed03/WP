<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';

// Verifica si se recibieron los parámetros necesarios
if(isset($_GET['id_alumno']) && isset($_GET['id_carrera'])) {
    $id_alumno = $_GET['id_alumno'];
    $id_carrera = $_GET['id_carrera'];

    // Eliminar las calificaciones del alumno en materias asociadas a la carrera que se está cambiando
    $sql_delete_calificaciones = "DELETE c FROM calificaciones c 
                                  INNER JOIN asignacion_materias_carrera amc ON c.id_materia = amc.id_materia
                                  WHERE c.id_alumno = $id_alumno AND amc.id_carrera <> $id_carrera";
    $result_delete_calificaciones = $conn->query($sql_delete_calificaciones);

    header("Location: listado_alumnos.php");
    exit();
} else {
    // Si no se recibieron los parámetros, redirige a la página de listado de alumnos
    header("Location: listado_alumnos.php");
    exit();
}
?>
