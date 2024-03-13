<?php
// Incluir archivo de conexión a la base de datos
include 'db.php';

if(isset($_GET['id_materia'])){
    $id_materia = $_GET['id_materia'];

    // Eliminar todas las asignaciones de esta materia
    $sql_delete_asignaciones = "DELETE FROM asignacion_materias_alumno WHERE id_materia = $id_materia";
    $result_delete_asignaciones = $conn->query($sql_delete_asignaciones);

    // Redirigir de vuelta a la lista de carreras después de completar la eliminación
    header("Location: listado_carreras.php");
    exit();
} else {
    echo "ID de materia no proporcionado.";
}
?>
