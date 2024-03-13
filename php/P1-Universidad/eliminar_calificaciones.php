<?php
//integrar archivo de conexion
include 'db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Eliminar las calificaciones del alumno
    $sql_delete_calificaciones = "DELETE FROM calificaciones WHERE id_alumno = $id";
    $result_delete_calificaciones = $conn->query($sql_delete_calificaciones);

    // Eliminar las asignaciones de materias del alumno
    $sql_delete_asignaciones = "DELETE FROM asignacion_materias_alumno WHERE id_alumno = $id";
    $result_delete_asignaciones = $conn->query($sql_delete_asignaciones);

    header("Location: listado_alumnos.php"); // Redirigir de vuelta al listado de alumnos
    exit();
} else {
    echo "ID de alumno no proporcionado.";
}
?>
