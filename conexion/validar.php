<?php
session_start();
include_once '../conexion/cone.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['txtusu']);
    $contrasenia = trim($_POST['txtpass']);

    $stmt = $con->prepare("SELECT usu_id, usu_pass FROM producto WHERE usu_usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();

        if (password_verify($contrasenia, $hash)) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id'] = $id;
            $stmt->close();
            $con->close();
            header("Location: ../productos.php");
            exit();
        } else {
            /*$stmt->close();
            $con->close();*/
            echo 'Contraseña incorrecta';
            echo 'contraseña ingresada: ' .$contrasenia. '<br>';
            echo 'contraseña guardada: ' .$hash;
            exit();
        }
    } else {
        $stmt->close();
        $con->close();
        echo 'El usuario no existe.';
        exit();
    }
}