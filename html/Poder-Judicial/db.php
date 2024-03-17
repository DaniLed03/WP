<?php
    //CONEXIÓN A LA BASE DE DATOS
    $servername ="localhost";
    $username= "root";
    $password ="D4n13l2003";
    $dbname= "poder_judicial";

    //crear conexion
    $conn= new mysqli($servername,$username,$password, $dbname);

    //verificar la conexion
    if($conn->connect_error){
        die("Conexion fallida: " . $conn->connect_error);
    }
?>