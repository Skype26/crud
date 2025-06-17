<?php
include_once("conexion/conexion.php");
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
                    <h1 class="p-10 text-5xl font-bold">Agregar Sub Categoria</h1>
                </div>


                <div class="bg-white pt-3">

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nombre = trim($_POST["txt_nombre"]);

                        if (!empty($nombre)) {
                            $stmt = $enlace->prepare("INSERT INTO tb_subcat (nom_subcat) VALUES (?)");
                            $stmt->bind_param("s", $nombre);
                            $stmt->execute();
                            $stmt->close(); 
                            header("Location: subcategoria_add.php?success=1");
                            exit;
                        } else {
                            header("Location: subcategoria_add.php?error=1");
                            exit;
                        }
                    }

                    if(isset($_GET["success"])){
                        echo "<a href='subcategoria.php'><div
                                class='p-8 m-3 flex items-center justify-center bg-green-200 rounded-lg border-3 border-green-400'>
                                <i class='fa-solid fa-circle-check mr-2'></i>
                                Producto Guardado Correctamente
                            </div></a>";
                    }
                    if(isset($_GET["error"])){
                        echo "<div
                        class='p-8 m-3 flex items-center justify-center bg-amber-200 rounded-lg border-3 border-amber-400'>
                        <i class='fa-solid fa-circle-exclamation mr-2'></i>
                        Datos incompletos o Tipo de datos Incorrectos
                        </div>";
                    }
                    ?>



                    <form action="" method="POST" class="flex flex-col p-15 mx-1/4 items-center justify-center">
                        <div class="flex mb-4">
                            <div class="flex flex-col mx-3">
                                <label class="mb-3">Nombre:</label>
                                <input name="txt_nombre" class="border rounded px-4 py-2 mb-5" type="text"
                                    placeholder="Ingrese su Nombre">
                            </div>
                        </div>

                        <input class="m-2 bg-green-300 hover:bg-green-400 p-3 rounded-lg cursor-pointer" type="submit"
                            value="Agregar">
                        <a href="#" class="m-2 bg-red-400 hover:bg-red-300 p-3 rounded-lg text-white">Cancelar</a>
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