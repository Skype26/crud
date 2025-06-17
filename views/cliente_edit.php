<?php
include_once("conexion/conexion.php");

$id_cliente = $_GET["id_cliente"] ? $_GET["id_cliente"] : "";

$stmt = $enlace->prepare("SELECT nom_cliente, ape_cliente, dir_cliente, email_cliente, tel_cliente, freg_cliente FROM tb_clientes WHERE id_cliente = (?)");
$stmt->bind_param("s", $id_cliente);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nombre, $apellido, $direccion, $email, $telefono, $fecha);
$stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once("head.php");
?>

<body class="bg-gray-200 font-sans">
    <?php
    include_once("barra_sup.php");
    ?>
    <div class="flex">
        <?php
        include_once("navegacion.php");
        ?>

        <div class="h-screen w-full flex flex-col">


            <!-- PANEL CLIENTE -->
            <div class="w-full">
                <!-- TITULO CLIENTE -->
                <div class="flex justify-between items-center">
                    <h1 class="p-10 text-5xl font-bold">Editar Cliente</h1>
                </div>


                <div class="bg-white pt-3">

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nombre = trim($_POST["txt_nombre"]);
                        $apellido = trim($_POST["txt_apellido"]);
                        $direccion = trim($_POST["txt_direccion"]);
                        $email = trim($_POST["txt_email"]);
                        $telefono = trim($_POST["txt_telefono"]);

                        if (!empty($nombre) && !empty($apellido) && !empty($direccion) && !empty($email) && is_numeric(($telefono))) {
                            $stmt = $enlace->prepare("UPDATE tb_clientes SET nom_cliente=?, ape_cliente=?, dir_cliente=?, email_cliente=?, tel_cliente=? WHERE id_cliente=?");
                            $stmt->bind_param("ssssss", $nombre, $apellido, $direccion, $email, $telefono, $id_cliente);
                            $stmt->execute();
                            $stmt->close();
                            header("Location: cliente_edit.php?id_cliente=" . $id_cliente . " &&success=1");
                            exit;
                        } else {
                            header("Location: cliente_edit.php?id_cliente=" . $id_cliente . " &&error=1");
                            exit;
                        }
                    }

                    if (isset($_GET["success"])) {
                        echo "<a href='cliente.php'><div
                                class='p-8 m-3 flex items-center justify-center bg-green-200 rounded-lg border-3 border-green-400'>
                                <i class='fa-solid fa-circle-check mr-2'></i>
                                Datos Guardados Correctamente
                            </div></a>";
                    }
                    if (isset($_GET["error"])) {
                        echo "<div
                        class='p-8 m-3 flex items-center justify-center bg-amber-200 rounded-lg border-3 border-amber-400'>
                        <i class='fa-solid fa-circle-exclamation mr-2'></i>
                        Datos incompletos
                        </div>";
                    }
                    ?>



                    <form action="" method="POST" class="flex flex-col p-15 mx-1/4 items-center justify-center">
                        <label class="mb-3">Id:</label>
                        <input name="txt_nombre" class="border rounded px-4 py-2 mb-5 bg-gray-200" type="text" readonly
                            value="<?php echo $id_cliente ?>">
                        <div class="flex mb-4">
                            <div class="flex flex-col mx-3">
                                <label class="mb-3">Nombre:</label>
                                <input name="txt_nombre" class="border rounded px-4 py-2 mb-5" type="text"
                                    placeholder="Ingrese su Nombre" value="<?php echo $nombre ?>">
                                <label class="mb-3">Apellido:</label>
                                <input name="txt_apellido" class="border rounded px-4 py-2 mb-5" type="text"
                                    placeholder="Ingrese su Apellido" value="<?php echo $apellido ?>">
                                <label class="mb-3">Direccion:</label>
                                <input name="txt_direccion" class="border rounded px-4 py-2 mb-5" type="text"
                                    placeholder="e.j. Av. Ejemplo / Urb. Ejemplo" value="<?php echo $direccion ?>">
                            </div>

                            <div class="flex flex-col mx-3">
                                <label class="mb-3">Email:</label>
                                <input name="txt_email" class="border  rounded px-4 py-2 mb-5" type="text"
                                    placeholder="example@gmail.com" value="<?php echo $email ?>">
                                <label class="mb-3">Telefono:</label>
                                <input name="txt_telefono" class="border  rounded px-4 py-2 mb-5" type="text"
                                    placeholder="Numero de Telefono" value="<?php echo $telefono ?>">
                            </div>
                        </div>

                        <input class="m-2 bg-green-300 hover:bg-green-400 p-3 rounded-lg cursor-pointer" type="submit"
                            value="Editar">
                        <a href="cliente.php"
                            class="m-2 bg-red-400 hover:bg-red-300 p-3 rounded-lg text-white">Cancelar</a>
                    </form>
                </div>

            </div>
            <?php
            include_once("footer.php");
            ?>
        </div>
    </div>
</body>

</html>