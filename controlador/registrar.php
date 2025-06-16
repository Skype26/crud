<?php
session_start(); // Inicia la sesión para manejar el estado del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../conexion/cone.php'; // Asegúrate de incluir la conexión

    $usuario = trim($_POST['txtusu']);
    $contraseña = trim($_POST['txtpass']);

    // Verifica si el usuario ya existe
    $stmt = $con->prepare("SELECT usu_id, usu_pass FROM producto WHERE usu_usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'El usuario ya existe.';
    } else {
        // Hashea la contraseña antes de guardar
        $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO producto (usu_usuario, usu_pass) VALUES (?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $usuario, $contraseñaHash);

        if ($stmt->execute()) {
            echo 'Usuario registrado exitosamente.';
            header("Location: ../index.php"); // Redirige al usuario a la página de inicio de sesión
            exit();
        } else {
            echo 'Error al registrar usuario.';
        }
    }
    $stmt->close();
    $con->close();
}