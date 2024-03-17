<?php
session_start();
require 'db.php'; // Archivo con la conexión a la base de datos

if(isset($_POST['Nom_Usuario']) && isset($_POST['contrasena'])) {
    $username = $_POST['Nom_Usuario'];
    $password = $_POST['contrasena'];
    
    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE Nom_Usuario='$username' AND contrasena='$password'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        // Usuario autenticado, redirigir a la página de bienvenida
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: welcome.php'); // Redirige al usuario a la página de bienvenida
        exit;
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>
