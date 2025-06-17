<?php
session_start();
include_once("conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST['txt_usuario']);
    $password = trim($_POST['txt_password']);

    // Usa la variable correcta de conexión
    $smt = $enlace->prepare("SELECT usu_usuario, usu_pass FROM tb_usuario WHERE usu_usuario = ?");
    $smt->bind_param("s", $usuario);
    $smt->execute();
    $smt->store_result();

    if ($smt->num_rows === 1) {
        $smt->bind_result($u, $p);
        $smt->fetch();

        if (password_verify($password, $p)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: views/inicio.php");
            exit;
        } else {
            echo "<div class='text-red-600 w-full'>Contraseña incorrecta</div>";
            echo $password;
        }
    } else {
        echo "<div class='text-red-600 w-full'>Usuario no encontrado</div>";
    }
    $smt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Bienvenido!</title>
</head>

<body>
    <div
        class="absolute inset-x-0 inset-y-0 mx-30 my-10 font-sans bg-blue-400 rounded-lg flex justify-center items-center">
        <form method="POST"
            class="absolute inset-x-0 mx-50 flex flex-col border border-white p-30 rounded-lg bg-white shadow-lg">

            <div class="inset-x-0 flex justify-center">
                <h1 class="text-3xl font-bold mb-8">
                    Iniciar Sesión
                </h1>
            </div>

            <label class="font-bold">Usuario: </label>
            <input name="txt_usuario" placeholder="ejemplo@unjfsc.edu.pe" type="text"
                class="focus:shadow-lg border border-black bg-gray-100 rounded-lg mt-3 mb-5 p-3">


            <label class="font-bold">Contraseña: </label>
            <input name="txt_password" placeholder="Ingrese su Contraseña" type="password"
                class="focus:shadow-lg border border-black bg-gray-100 rounded-lg mt-3 mb-7 p-3">

            <button class="mt-3 shadow-lg bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded">
                INGRESAR
            </button>

            <div class="mt-7 flex flex-col gap-3 text-purple-600 items-center">
                <a href="#" class="hover:underline hover:text-blue-600">¿Olvidaste tu contraseña?</a>
                <a href="login/register.php" class="hover:underline hover:text-blue-600">Registrate</a>
            </div>

        </form>
    </div>
</body>

</html>