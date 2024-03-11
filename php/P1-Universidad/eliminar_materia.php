<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';

// Obtener el ID de la materia a eliminar a través de la variable GET
$id_materia = $_GET['id_materia'];

// Crear la consulta SQL para eliminar la materia con el ID correspondiente
$sql = "DELETE FROM materias WHERE id_materia = $id_materia";

// Ejecutar la consulta SQL
$result = $conn->query($sql);

// Redireccionar a la página de listado de materias después de eliminar
header("Location: listado_materias.php");
?>
