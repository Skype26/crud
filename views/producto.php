<?php
include_once("conexion/conexion.php");
if (isset($_POST['eliminar_id'])) {
    $eliminar_id = intval($_POST['eliminar_id']);
    $stmt = $enlace->prepare("DELETE FROM tb_producto WHERE id_prod = ?");
    $stmt->bind_param("i", $eliminar_id);
    $stmt->execute();
    $stmt->close();
    // Opcional: redirige para evitar reenvío del formulario
    header("Location: producto.php?deleted=1");
    exit;
}
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
                    <h1 class="p-10 text-5xl font-bold">Lista Productos</h1>
                    <a href="producto_add.php" class="m-10 bg-green-300 hover:bg-green-400 p-3 rounded-lg">
                        Agregar Producto
                    </a>
                </div>

                <?php
                if (isset($_GET['deleted'])) {
                    echo "<div class='p-10 m-3 bg-green-200 text-green-800 rounded-lg border-3 border-green-400'>Producto eliminado exitosamente</div>";
                }
                ?>

                <!-- TABLA -->
                <div class="w-full mt-6">
                    <table class="min-w-full border border-gray-400 bg-white">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Nombre</th>
                                <th class="border px-4 py-2">Detalles</th>
                                <th class="border px-4 py-2">Modelo</th>
                                <th class="border px-4 py-2">Marca</th>
                                <th class="border px-4 py-2">Categoria</th>
                                <th class="border px-4 py-2">Subcategoria</th>
                                <th class="border px-4 py-2">Precio</th>
                                <th class="border px-4 py-2">Stock</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $enlace->prepare("SELECT p.id_prod, p.nom_prod, p.det_prod, p.mod_prod, p.mar_prod, c.nombre_cat, s.nom_subcat, p.prec_prod, p.st_prod FROM tb_producto AS p JOIN tb_categoria AS c ON c.id_cat = p.cat_prod JOIN tb_subcat AS s ON s.id_subcat = p.subcat_prod;");
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($id, $nombre, $detalle, $modelo, $marca, $categoria, $subcategoria, $precio, $stock);
                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td class='border px-4 py-2'>" . $id . "</td>";
                                echo "<td class='border px-4 py-2'>" . $nombre . "</td>";
                                echo "<td class='border px-4 py-2'>" . $detalle . "</td>";
                                echo "<td class='border px-4 py-2'>" . $modelo . "</td>";
                                echo "<td class='border px-4 py-2'>" . $marca . "</td>";
                                echo "<td class='border px-4 py-2'>" . $categoria . "</td>";
                                echo "<td class='border px-4 py-2'>" . $subcategoria . "</td>";
                                echo "<td class='border px-4 py-2'>" . $precio . "</td>";
                                echo "<td class='border px-4 py-2'>" . $stock . "</td>";
                                echo "<td class='border px-4 py-2 flex items-center justify-center'>
                                <a href='producto_edit.php?id_producto=" . $id . "' class='bg-blue-500 hover:bg-blue-600 p-3 rounded-lg'>
                                    Editar
                                </a>
                                <form action='' method='POST'>
                                <input type='hidden' name='eliminar_id' value='" . $id . "'>
                                <button type='submit' class='bg-red-500 hover:bg-red-600 p-3 rounded-lg cursor-pointer' onclick=\"return confirm('¿Seguro que deseas eliminar este cliente?');\">
                                    Eliminar
                                </button>
                                </form>
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