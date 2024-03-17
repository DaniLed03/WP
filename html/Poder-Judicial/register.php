<?php
require 'db.php'; // Archivo con la conexión a la base de datos

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $nom_usuario = $_POST['nom_usuario'];
    $contrasena = $_POST['contrasena'];
    $cargo = $_POST['cargo'];
    $edad = $_POST['edad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $direccion = $_POST['direccion'];
    $rol = $_POST['rol'];

    
    // Consulta SQL para insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (Nombres, Apellido_Paterno, Apellido_Materno, Nom_Usuario, contrasena, Cargo, Edad, Fecha_Nacimiento, Sexo, Direccion, Rol) 
    VALUES 
    ('$nombre', '$apellido_paterno', '$apellido_materno', '$nom_usuario', '$contrasena', '$cargo', '$edad', '$fecha_nacimiento', '$sexo', '$direccion', '$rol')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario registrado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
