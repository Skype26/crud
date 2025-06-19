<?php
include_once("../conexion/conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (trim($_POST["txt_password"]) == trim($_POST["txt_password_repeated"])) {

        $username = trim($_POST['txt_usuario']);
        $password = password_hash(trim($_POST['txt_password']), PASSWORD_DEFAULT);

        $stmt = $enlace->prepare("INSERT INTO tb_usuario (usu_usuario, usu_pass) VALUES (?,?)");
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();

    } else {
        header("Location: error.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="../jquery.min.js"></script>
    <script src="function.js"></script>
    <title>Panel Principal</title>
</head>
<body>

    <div
        class="absolute inset-x-0 inset-y-0 mx-30 my-10 font-sans bg-blue-400 rounded-lg flex justify-center items-center">
        <form method="POST"
            class="absolute inset-x-0 mx-50 flex flex-col border border-white p-30 rounded-lg bg-white shadow-lg">

            <div class="inset-x-0 flex justify-center">
                <h1 class="text-3xl font-bold mb-8">
                    Resistrate
                </h1>
            </div>

            <!-- USUARIO -->
            <label class="font-bold">Ingresa un Usuario: </label>
            <input name="txt_usuario" placeholder="ejemplo@unjfsc.edu.pe" type="text"
                class="focus:shadow-lg border border-black bg-gray-100 rounded-lg mt-3 mb-5 p-3">

            <!-- CONTRASEÑA -->
            <label class="font-bold">Ingresa tu Contraseña: </label>
            <input name="txt_password" placeholder="Ingrese su Contraseña" type="password"
                class="focus:shadow-lg border border-black bg-gray-100 rounded-lg mt-3 mb-7 p-3">

            <!-- CONTRASEÑA REPETIDA -->
            <label class="font-bold">Repite una vez mas tu Contraseña: </label>
            <input name="txt_password_repeated" placeholder="Repita su Contraseña" type="password"
                class="focus:shadow-lg border border-black bg-gray-100 rounded-lg mt-3 mb-7 p-3">



            <input type="submit" value="REGISTRATE"
                class="mt-3 shadow-lg bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded">



            <div class="mt-7 flex flex-col gap-3 text-purple-600 items-center">
                <a href="../index.php" class="hover:underline hover:text-blue-600">¿Ya tienes una cuenta? Inicia Sesión</a>
            </div>

        </form>
    </div>

</body>

</html>