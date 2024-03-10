<?php
include 'db.php';

$id_materia = $_GET['id_materia'];
$sql = "DELETE FROM materias WHERE id_materia = $id_materia";
$result = $conn->query($sql);

header("Location: listado_materias.php");
?>
