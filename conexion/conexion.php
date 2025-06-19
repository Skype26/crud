<?php
    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $db = "tienda";

    $enlace = mysqli_connect($hostname, $username, $password, $db);
    
    if($enlace) {
        $response_connection = "Conexion establecida con éxito";
    } else{
        die("ERROR: ". mysqli_connect_error());
    }
?>
