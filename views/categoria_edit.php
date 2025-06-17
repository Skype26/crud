<?php
include_once("conexion/conexion.php");

$id_cat = $_GET["id_cat"] ? $_GET["id_cat"] : "";

$stmt = $enlace->prepare("SELECT c.nombre_cat, c.id_subcat, s.nom_subcat FROM tb_categoria AS c JOIN tb_subcat AS s ON s.id_subcat = c.id_subcat WHERE id_cat = (?)");
$stmt->bind_param("i", $id_cat);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nombre_cat, $id_subcat, $nombre_scat);
$stmt->fetch();
$stmt->close();
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
                    <h1 class="p-10 text-5xl font-bold">Editar Categoria</h1>
                </div>


                <div class="bg-white pt-3">

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nombre = trim($_POST["txt_nombre"]);
                        $scat = trim($_POST["txt_scat"]);

                        if (!empty($nombre) && !empty($scat)) {
                            $stmt = $enlace->prepare("UPDATE tb_categoria SET nombre_cat=?, id_subcat=? WHERE id_cat = ?");
                            $stmt->bind_param("sii", $nombre, $scat, $id_cat);
                            $stmt->execute();
                            $stmt->close();
                            header("Location: categoria_edit.php?id_cat=" . $id_cat . " &success=1");
                            exit;
                        } else {
                            header("Location: categoria_edit.php?id_cat=" . $id_cat . " &error=1");
                            exit;
                        }
                    }

                    if (isset($_GET["success"])) {
                        echo "<a href='categoria.php'><div
                                class='p-8 m-3 flex items-center justify-center bg-green-200 rounded-lg border-3 border-green-400'>
                                <i class='fa-solid fa-circle-check mr-2'></i>
                                Producto Guardado Correctamente
                            </div></a>";
                    }
                    if (isset($_GET["error"])) {
                        echo "<div
                        class='p-8 m-3 flex items-center justify-center bg-amber-200 rounded-lg border-3 border-amber-400'>
                        <i class='fa-solid fa-circle-exclamation mr-2'></i>
                        Datos incompletos o Tipo de datos Incorrectos
                        </div>";
                    }
                    ?>



                    <form action="" method="POST" class="flex flex-col p-15 mx-1/4 items-center justify-center">
                        <label class="mb-3">Id:</label>
                        <input name="txt_id" class="border rounded px-4 py-2 mb-5 bg-gray-200" type="text" readonly
                            value="<?php echo $id_cat ?>">
                        <div class="flex mb-4">
                            <div class="flex flex-col mx-3">
                                <label class="mb-3">Nombre:</label>
                                <input name="txt_nombre" class="border rounded px-4 py-2 mb-5" type="text"
                                    placeholder="Ingrese su Nombre" value="<?php echo $nombre_cat ?>">
                                <label class="mb-3">Selecciona Subcategoría:</label>
                                <select name="txt_scat" class="border rounded px-4 py-2 mb-5">
                                    <option value="<?php echo $id_subcat ?>"><?php echo $nombre_scat ?></option>
                                    <?php
                                    $stmt = $enlace->prepare("SELECT id_cat, nombre_cat FROM tb_categoria WHERE id_cat <> (?)");
                                    $stmt->bind_param("i", $id_cat);
                                    $stmt->execute();
                                    $stmt->store_result();
                                    $stmt->bind_result($id, $cat);
                                    while ($stmt->fetch()) {
                                        echo "<option value='$id'>" . $cat . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <input class="m-2 bg-green-300 hover:bg-green-400 p-3 rounded-lg cursor-pointer" type="submit"
                            value="Agregar">
                        <a href="categoria.php"
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