<?php
include_once("../conexion/conexion.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['txt_nombre']);
    $apellido = trim($_POST['txt_apellido']);
    $direccion = trim($_POST['txt_direccion']);
    $email = trim($_POST['txt_email']);
    $telefono = trim($_POST['txt_telefono']);

    if (empty($nombre) && empty($apellido) && empty($direccion) && empty($email) && empty($telefono)) {
        header('Location: cliente.php?');
        echo"
            <div class='flex items-center justify-center p-6 my-5 w-3/4 mx-auto rounded-lg border-3 border-red-700 text-lg bg-red-500 text-white'>
                <i class='fa-solid fa-xmark mr-2'></i>
                Registro fallido...
            </div>
        ";
    } else {
        $stmt = $enlace->prepare('INSERT INTO tb_clientes (nom_cliente, ape_cliente, dir_cliente, email_cliente, tel_cliente) VALUES(?,?,?,?,?)');
        $stmt->bind_param('sssss', $nombre, $apellido, $direccion, $email, $telefono);
        $stmt->execute();
        $stmt->close();
        echo "
            <div class='flex items-center justify-center p-6 my-5 w-3/4 mx-auto rounded-lg border-3 border-green-700 text-lg bg-green-400 text-white'>
                <i class='fa-solid fa-check mr-2'></i>
                Registro con éxito!
            </div>
        ";
    }
}
?>