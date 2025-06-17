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
                    <h1 class="p-10 text-5xl font-bold">Lista Sub Categorías</h1>
                    <a href="subcategoria_add.php" class="m-10 bg-green-300 hover:bg-green-400 p-3 rounded-lg">
                        Agregar Sub Categoría
                    </a>
                </div>

                <!-- TABLA -->
                <div class="w-full mt-6">
                    <table class="min-w-full border border-gray-400 bg-white">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Nombre</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $enlace->prepare("SELECT id_subcat, nom_subcat FROM tb_subcat");
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($id, $nombre);
                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td class='border px-4 py-2'>" . $id . "</td>";
                                echo "<td class='border px-4 py-2'>" . $nombre . "</td>";
                                echo "<td class='border px-4 py-2 flex items-center justify-center'>
                                <a href='subcategoria_edit.php?id_subcategoria=" . $id . "' class='bg-blue-500 hover:bg-blue-600 p-3 rounded-lg'>
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
            include_once("footer.php");
            ?>
        </div>
    </div>
</body>

</html>