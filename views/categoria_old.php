<?php
include_once("conexion/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once("../includes/head.php");
?>

<body class="bg-gray-200 font-sans">
    <?php
    include_once("../includes/barra_sup.php");
    ?>
    <div class="flex">
        <?php
        include_once("../includes/barra_lat.php");
        ?>

        <div class="h-screen w-full flex flex-col">


            <!-- PANEL CLIENTE -->
            <div class="w-full">
                <!-- TITULO CLIENTE -->
                <div class="flex justify-between items-center">
                    <h1 class="p-10 text-5xl font-bold">Lista Categorías</h1>
                    <a href="categoria_add.php" class="m-10 bg-green-300 hover:bg-green-400 p-3 rounded-lg">
                        Agregar Categoría
                    </a>
                </div>

                <!-- TABLA -->
                <div class="w-full mt-6">
                    <table class="min-w-full border border-gray-400 bg-white">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Nombre</th>
                                <th class="border px-4 py-2">Sub Categoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $enlace->prepare("SELECT c.id_cat, c.nombre_cat, c.id_subcat, s.nom_subcat FROM tb_categoria AS c JOIN tb_subcat AS s ON s.id_subcat = c.id_subcat");
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($id, $nombre, $id_subcat, $nombre_scat);
                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td class='border px-4 py-2'>" . $id . "</td>";
                                echo "<td class='border px-4 py-2'>" . $nombre . "</td>";
                                echo "<td class='border px-4 py-2'>" . $nombre_scat . "</td>";
                                echo "<td class='border px-4 py-2 flex items-center justify-center'>
                                <a href='categoria_edit.php?id_cat=" . $id . "' class='bg-blue-500 hover:bg-blue-600 p-3 rounded-lg'>
                                    Editar
                                </a>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <?php
            include_once("../includes/footer.php");
            ?>
        </div>
    </div>
</body>

</html>