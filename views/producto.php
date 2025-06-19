<?php
include_once("../conexion/conexion.php");

// ELIMINAR SELECCIONADOS
if (isset($_POST['ids'])) {
    $ids = array_map('intval', $_POST['ids']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $stmt = $enlace->prepare("DELETE FROM tb_producto WHERE id_prod IN ($placeholders)");
    $types = str_repeat('i', count($ids));
    $stmt->bind_param($types, ...$ids);
    $stmt->execute();
    header("Location: producto.php?deleted=1");
}

//ELIMINAR
if (isset($_GET['id']) && isset($_GET['d'])) {
    $eliminar_id = !empty($_GET['id']) ? $_GET['id'] : "";
    $stmt = $enlace->prepare("DELETE FROM tb_producto WHERE id_prod = ?");
    $stmt->bind_param("i", $eliminar_id);
    $stmt->execute();
    $stmt->close();
    header("Location: producto.php?deleted=1");
    exit;
}

// INSERTAR
if (isset($_POST['agregar'])) {
    $nombre = trim($_POST["txt_nombre"]);
    $detalles = trim($_POST["txt_detalle"]);
    $modelo = trim($_POST["txt_modelo"]);
    $marca = trim($_POST["txt_marca"]);
    $scat = trim($_POST["txt_categoria"]);
    $precio = trim($_POST["txt_precio"]);
    $stock = trim($_POST["txt_stock"]);

    if (!empty($nombre) && !empty($detalles) && !empty($modelo) && !empty($marca) && !empty($scat) && is_numeric(($precio)) && is_numeric(($stock))) {
        $stmt = $enlace->prepare("INSERT INTO tb_producto (nom_prod, det_prod, mod_prod, mar_prod, cat_prod, prec_prod, st_prod) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssidi", $nombre, $detalles, $modelo, $marca, $scat, $precio, $stock);
        $stmt->execute();
        $stmt->close();
        header("Location: producto.php?s=1&m=1");
        exit;
    } else {
        header("Location: producto.php?e=1&m=1");
        exit;
    }
}

// EDITAR
if (isset($_GET['id'])) {
    $id = !empty($_GET['id']) ? $_GET['id'] : "";
    $stmt = $enlace->prepare('SELECT p.nom_prod, p.det_prod, p.mod_prod, p.mar_prod, c_sub.id_cat, concat(c_padre.nombre_cat," - ", c_sub.nombre_cat) AS Nombre_Categoria, p.prec_prod, p.st_prod FROM tb_producto AS p JOIN tb_categoria AS c_sub ON p.cat_prod = c_sub.id_cat LEFT JOIN tb_categoria AS c_padre ON c_sub.id_categoria_padre = c_padre.id_cat WHERE id_prod = (?);');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nombreE, $detalleE, $modeloE, $marcaE, $id_categoriaE, $nom_catE, $precioE, $stockE);
    $stmt->fetch();
}
if (isset($_POST['editar'])) {
    $nombre = trim($_POST["txt_nombre"]);
    $detalles = trim($_POST["txt_detalle"]);
    $modelo = trim($_POST["txt_modelo"]);
    $marca = trim($_POST["txt_marca"]);
    $scat = trim($_POST["txt_categoria"]);
    $precio = trim($_POST["txt_precio"]);
    $stock = trim($_POST["txt_stock"]);

    if (!empty($nombre) && !empty($detalles) && !empty($modelo) && !empty($marca) && !empty($scat) && is_numeric(($precio)) && is_numeric(($stock))) {
        $stmt = $enlace->prepare("UPDATE tb_producto SET nom_prod = (?), det_prod = (?),  mod_prod = (?), mar_prod = (?), cat_prod = (?), prec_prod = (?), st_prod = (?) WHERE id_prod = (?);");
        $stmt->bind_param("ssssidii", $nombre, $detalles, $modelo, $marca, $scat, $precio, $stock, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: producto.php?id=" . $id . " &s=1&m=2");
        exit;
    } else {
        header("Location: producto.php?id=" . $id . " &e=1&m=2");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once("../includes/head.php");
?>

<body class="bg-white font-sans flex flex-col min-h-screen">
    <?php
    include_once("../includes/barra_sup.php");
    ?>


    <div class="flex pt-25">
        <?php
        include_once("../includes/barra_lat.php");
        ?>

        <div class="flex-1 flex-col">


            <!-- PANEL DERECHO -->
            <div method="POST" class="w-full">
                <!-- TITULO -->
                <div class="flex justify-between items-center">

                    <!-- BOTONES TITULO -->
                    <h1 id="lista" class="p-10 text-5xl font-bold">Lista Productos</h1>
                    <div class="flex justify-center items-center">
                        <button id="btnAgregar"
                            class="mr-10 my-4 text-white text-lg bg-green-400 p-3 rounded-lg cursor-pointer hover:shadow-lg transition ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-green-500">
                            <i class="fa-solid fa-plus"></i>
                            Agregar
                        </button>
                    </div>

                    <!-- FONDO AGREGAR -->
                    <div id="ModalAgregar"
                        class="fixed inset-0 bg-black/70 flex items-center z-50 opacity-0 pointer-events-none transition-opacity duration-500">
                        <!-- MODAL -->
                        <form method="POST" class="relative bg-white w-1/2 mx-auto p-15 rounded-lg">
                            <button onclick="window.location.href='producto.php';" type="button"
                                class="absolute right-0 top-0 scale-150"><i
                                    class="fa-solid fa-x mr-12 mt-12 text-gray-500 hover:text-black cursor-pointer"></i></button>
                            <h1 class="text-center font-bold text-4xl mb-10">Nuevo</h1>
                            <!-- RESPUESTA -->
                            <?php
                            if (isset($_GET['m'])) {
                                if (isset($_GET['s'])) {
                                    echo "<div
                                    class='flex items-center justify-center p-6 my-5 w-3/4 mx-auto rounded-lg border-3 border-green-700 text-lg bg-green-400 text-white'>
                                    <i class='fa-solid fa-check mr-2'></i>
                                    Registro con éxito!
                                </div>";
                                }
                                if (isset($_GET['e'])) {
                                    echo "<div
                                    class='flex items-center justify-center p-6 my-5 w-3/4 mx-auto rounded-lg border-3 border-red-700 text-lg bg-red-500 text-white'>
                                    <i class='fa-solid fa-xmark mr-2'></i>
                                    Registro fallido...
                                </div>";
                                }
                            }
                            ?>
                            <div class="flex w-3/4 mx-auto text-lg justify-center">
                                <input name="agregar" class="hidden" readonly>
                                <div class="flex flex-col mx-4">
                                    <label class="mb-3">Nombre:</label>
                                    <input name="txt_nombre"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Nombre">
                                    <label class="mb-3">Detalles:</label>
                                    <input name="txt_detalle"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Detalle">
                                    <label class="mb-3">Modelo:</label>
                                    <input name="txt_modelo"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Modelo">
                                    <label class="mb-3">Marca:</label>
                                    <input name="txt_marca"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese una Marca">
                                </div>
                                <div class="flex flex-col mx-4">
                                    <label class="mb-3">Categoría:</label>
                                    <select name="txt_categoria"
                                        class="border rounded px-4 py-2 mx-auto mb-5 transition focus:scale-105 focus:shadow-lg">
                                        <?php
                                        $stmt = $enlace->prepare("SELECT h.id_cat, CONCAT(p.nombre_cat, ' - ', h.nombre_cat) AS nombre_categoria_completa FROM tb_categoria AS h JOIN tb_categoria AS p ON h.id_categoria_padre = p.id_cat WHERE h.id_categoria_padre IS NOT NULL ORDER BY h.id_cat;");
                                        $stmt->execute();
                                        $stmt->store_result();
                                        $stmt->bind_result($id_listar_cat, $nombre_listar_cat);
                                        while ($stmt->fetch()) {
                                            echo "<option value='" . $id_listar_cat . "'>" . $nombre_listar_cat . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label class="mb-3">Stock:</label>
                                    <input name="txt_stock"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Stock">
                                    <label class="mb-3">Precio:</label>
                                    <input name="txt_precio"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Precio">
                                </div>
                            </div>
                            <div class="text-lg text-white flex justify-center items-center mt-5">
                                <input
                                    class="m-2 bg-green-500 hover:bg-green-400 shadow-lg p-4 rounded-lg cursor-pointer transition hover:shadow-lg hover:-translate-y-1 hover:scale-110"
                                    type="submit" value="Agregar">
                            </div>
                        </form>
                    </div>

                    <!-- FONDO EDITAR -->
                    <div id="ModalEditar"
                        class="fixed inset-0 bg-black/70 flex items-center z-50 transition-opacity pointer-events-none opacity-0 duration-500">
                        <!-- MODAL -->
                        <form method="POST" class="relative bg-white w-1/2 mx-auto p-15 rounded-lg ">
                            <button onclick="window.location.href='producto.php';" type="button"
                                class="absolute right-0 top-0 scale-150"><i
                                    class="fa-solid fa-x mr-12 mt-12 text-gray-500 hover:text-black cursor-pointer"></i></button>
                            <h1 class="text-center font-bold text-4xl mb-4">Editar</h1>
                            <!-- RESPUESTA -->
                            <?php
                            if (isset($_GET['m'])) {
                                if (isset($_GET['s'])) {
                                    echo "<div
                                    class='flex items-center justify-center p-6 my-5 w-3/4 mx-auto rounded-lg border-3 border-green-700 text-lg bg-green-400 text-white'>
                                    <i class='fa-solid fa-check mr-2'></i>
                                    Modificación con éxito!
                                </div>";
                                }
                                if (isset($_GET['e'])) {
                                    echo "<div
                                    class='flex items-center justify-center p-6 my-5 w-3/4 mx-auto rounded-lg border-3 border-red-700 text-lg bg-red-500 text-white'>
                                    <i class='fa-solid fa-xmark mr-2'></i>
                                    Modificación fallida...
                                </div>";
                                }
                            }
                            ?>
                            <div class="flex w-3/4 mx-auto text-lg justify-center">
                                <input name="editar" class="hidden" readonly>
                                <div class="flex flex-col mx-4">
                                    <label class="mb-3">ID:</label>
                                    <input class="bg-gray-200 border rounded px-4 py-2 mb-5" type="text" readonly
                                        value="<?php echo $id ?>">
                                    <label class="mb-3">Nombre:</label>
                                    <input name="txt_nombre" value="<?php echo $nombreE ?>"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Nombre">
                                    <label class="mb-3">Detalles:</label>
                                    <input name="txt_detalle" value="<?php echo $detalleE ?>"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Detalle">
                                    <label class="mb-3">Modelo:</label>
                                    <input name="txt_modelo" value="<?php echo $modeloE ?>"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Modelo">
                                    <label class="mb-3">Marca:</label>
                                    <input name="txt_marca" value="<?php echo $marcaE ?>"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese una Marca">
                                </div>
                                <div class="flex flex-col mx-4">
                                    <label class="mb-3">Categoría:</label>
                                    <select name="txt_categoria"
                                        class="border rounded px-4 py-2 mx-auto mb-5 transition focus:scale-105 focus:shadow-lg">
                                        <option value="<?php echo $id_categoriaE ?>"><?php echo $nom_catE ?></option>
                                        <?php
                                        $stmt = $enlace->prepare("SELECT h.id_cat, CONCAT(p.nombre_cat, ' - ', h.nombre_cat) AS nombre_categoria_completa FROM tb_categoria AS h JOIN tb_categoria AS p ON h.id_categoria_padre = p.id_cat WHERE h.id_categoria_padre IS NOT NULL AND h.id_cat <> ? ORDER BY h.id_cat;");
                                        $stmt->bind_param("i", $id_categoriaE);
                                        $stmt->execute();
                                        $stmt->store_result();
                                        $stmt->bind_result($id_listar_cat, $nombre_listar_cat);
                                        while ($stmt->fetch()) {
                                            echo "<option value='" . $id_listar_cat . "'>" . $nombre_listar_cat . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label class="mb-3">Stock:</label>
                                    <input name="txt_stock" value="<?php echo $stockE ?>"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Stock">
                                    <label class="mb-3">Precio:</label>
                                    <input name="txt_precio" value="<?php echo $precioE ?>"
                                        class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                        type="text" placeholder="Ingrese un Precio">
                                </div>
                            </div>
                            <div class="text-white flex justify-center items-center mt-5">
                                <input class="m-2 bg-green-500 hover:bg-green-400 p-3 rounded-lg cursor-pointer"
                                    type="submit" value="Editar">
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                if (isset($_GET['deleted'])) {
                    echo "<div class='p-10 m-3 bg-green-200 text-green-800 rounded-lg border-3 border-green-400'>Cliente eliminado exitosamente</div>";
                }
                ?>

                <!-- TABLA -->
                <div class="w-full">
                    <form method="POST" class="flex flex-col">
                        <div id="tituloEliminarSeleccion" class="flex justify-left items-center hidden">

                            <!-- BOTONES TITULO ELIMINAR -->
                            <button id="btnEliminarTodos" type="submit"
                                onclick="return confirm('Estas seguro que deseas borrar las filas seleccionadas?')"
                                class="mx-6 my-4 text-white text-lg bg-red-500 p-3 rounded-lg cursor-pointer hover:shadow-lg transition ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-red-600">
                                <i class="fa-solid fa-trash"></i>
                                Elminar Seleccionados
                            </button>
                            <spam class="text-blue-600 mr-2"><i class="fa-solid fa-circle-check"></i></spam>
                            <h1 id="seleccion" class="py-5  text-2xl font-bold">Fila(s) Seleccionada(s)</h1>

                        </div>
                        <table class="w-full">
                            <thead>
                                <tr class="border-y border-gray-300 text-lg text-left text-gray-500">
                                    <th class="py-1 px-3">
                                        <input class='checkboxPadre accent-blue-600 scale-150  ml-2' type="checkbox">
                                    </th>
                                    <th class="py-1 px-5 font-medium text-shadow-md">ID</th>
                                    <th class="py-1 px-5 font-medium text-shadow-md">NOMBRES</th>
                                    <th class="py-1 px-5 font-medium text-shadow-md">DETALLES</th>
                                    <th class="py-1 px-5 font-medium text-shadow-md">MODELO</th>
                                    <th class="py-1 px-5 font-medium text-shadow-md">MARCA</th>
                                    <th class="py-1 px-5 font-medium text-shadow-md">CATEGORIA</th>
                                    <th class="py-1 px-5 font-medium text-shadow-md text-center">SUB-CATEGORIA</th>
                                    <th class="py-1 px-5 font-medium text-shadow-md text-center">STOCK</th>
                                    <th class="py-1 px-5 font-medium text-shadow-md text-right">PRECIO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $enlace->prepare("SELECT p.id_prod, p.nom_prod, p.det_prod, p.mod_prod, p.mar_prod, c_padre.nombre_cat AS Nombre_Categoria_Padre, c_sub.nombre_cat AS Nombre_Subcategoria, p.prec_prod, p.st_prod FROM tb_producto AS p JOIN tb_categoria AS c_sub ON p.cat_prod = c_sub.id_cat LEFT JOIN tb_categoria AS c_padre ON c_sub.id_categoria_padre = c_padre.id_cat;");
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($id, $nombre, $detalle, $modelo, $marca, $categoria, $subcategoria, $precio, $stock);
                                while ($stmt->fetch()) {
                                    echo "<tr class='fila transition border-y border-gray-300 px-5 py-2 hover:bg-gray-200 cursor-pointer'>";
                                    echo "<td class='p-5'><input name='ids[]' class='checkbox accent-blue-600 scale-150' type='checkbox' value='" . $id . "'></td>";
                                    echo "<td class='p-5'>" . $id . "</td>";
                                    echo "<td class='p-5'>" . $nombre . "</td>";
                                    echo "<td class='p-5'>" . $detalle . "</td>";
                                    echo "<td class='p-5'>" . $modelo . "</td>";
                                    echo "<td class='p-5'>" . $marca . "</td>";
                                    echo "<td class='p-5'>" . $categoria . "</td>";
                                    echo "<td class='p-5'>" . $subcategoria . "</td>";
                                    echo "<td class='p-5'>" . $stock . "</td>";
                                    echo "<td class='p-5 text-right'>" . $precio . "</td>";
                                    echo "<td class='flex items-center text-white justify-center'>
                                    <a href='producto.php?id=" . $id . "&m=2' class='m-2 transition bg-blue-500 hover:bg-blue-600 hover:shadow-lg p-3 rounded-lg'>
                                        <i class='fa-solid fa-pen mr-3'></i>Editar
                                    </a>
                                    <a href='producto.php?id=" . $id . "&d=1' onclick=\"return confirm('¿Seguro que deseas eliminar este cliente?');\" class='m-2 transition hover:shadow-lg bg-red-500 hover:bg-red-600 p-3 rounded-lg cursor-pointer'>
                                        <i class='fa-solid fa-trash mr-3'></i>Eliminar
                                    </a>
                                    </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <?php
            include_once("../includes/footer.php");
            ?>
        </div>
    </div>
</body>

</html>