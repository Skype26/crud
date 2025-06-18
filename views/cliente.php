<?php
include_once("../conexion/conexion.php");

// ELIMINAR
if (isset($_POST['ids'])) {
    // pendiente
}
if (isset($_GET['id']) && isset($_GET['d'])) {
    $eliminar_id = !empty($_GET['id']) ? $_GET['id'] : "";
    $stmt = $enlace->prepare("DELETE FROM tb_clientes WHERE id_cliente = ?");
    $stmt->bind_param("i", $eliminar_id);
    $stmt->execute();
    $stmt->close();
    header("Location: cliente.php?deleted=1");
    exit;
}



// INSERTAR
if (isset($_POST['agregar'])) {
    $nombre = trim($_POST['txt_nombre']);
    $apellido = trim($_POST['txt_apellido']);
    $direccion = trim($_POST['txt_direccion']);
    $email = trim($_POST['txt_email']);
    $telefono = trim($_POST['txt_telefono']);

    if (empty($nombre) && empty($apellido) && empty($direccion) && empty($email) && empty($telefono)) {
        header('Location: cliente.php?m=1&e=1');
    } else {
        $stmt = $enlace->prepare('INSERT INTO tb_clientes (nom_cliente, ape_cliente, dir_cliente, email_cliente, tel_cliente) VALUES(?,?,?,?,?)');
        $stmt->bind_param('sssss', $nombre, $apellido, $direccion, $email, $telefono);
        $stmt->execute();
        $stmt->close();
        header('Location:cliente.php?m=1&s=1');
    }
}

// EDITAR
if (isset($_GET['id'])) {
    $id = !empty($_GET['id']) ? $_GET['id'] : "";
    $stmt = $enlace->prepare('SELECT nom_cliente, ape_cliente, dir_cliente, email_cliente, tel_cliente, freg_cliente FROM tb_clientes WHERE id_cliente = (?)');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nombre, $apellido, $direccion, $email, $telefono, $fecha);
    $stmt->fetch();
}
if (isset($_POST['editar'])) {
    $nombre = trim($_POST["txt_nombre"]);
    $apellido = trim($_POST["txt_apellido"]);
    $direccion = trim($_POST["txt_direccion"]);
    $email = trim($_POST["txt_email"]);
    $telefono = trim($_POST["txt_telefono"]);

    if (!empty($nombre) && !empty($apellido) && !empty($direccion) && !empty($email) && is_numeric(($telefono))) {
        $stmt = $enlace->prepare("UPDATE tb_clientes SET nom_cliente=?, ape_cliente=?, dir_cliente=?, email_cliente=?, tel_cliente=? WHERE id_cliente=?");
        $stmt->bind_param("ssssss", $nombre, $apellido, $direccion, $email, $telefono, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: cliente.php?id=" . $id . " &s=1&m=2");
        exit;
    } else {
        header("Location: cliente.php?id=" . $id . " &e=1&m=2");
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

                    <h1 id="lista" class="p-10 text-5xl font-bold">Lista Clientes</h1>
                    <h1 id="seleccion" class="hidden p-10 text-5xl font-bold">Seleccionar filas</h1>
                    <!-- BOTONES TITULO -->
                    <div class="flex justify-center items-center">
                        <button id="btnAgregar"
                            class="mr-10 my-4 text-white text-lg bg-green-400 p-3 rounded-lg cursor-pointer hover:shadow-lg transition ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-green-500">
                            <i class="fa-solid fa-plus"></i>
                            Agregar
                        </button>
                        <!-- <input name="eliminarSeleccionados" type="hidden" value="1"> -->
                        <!-- <button id="btnEliminarTodos" type="submit"
                            onclick="return confirm('Estas seguro que deseas borrar las filas seleccionadas?')"
                            class="hidden mr-10 my-4 text-white text-lg bg-red-500 p-3 rounded-lg cursor-pointer hover:shadow-lg transition ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-red-600">
                            <i class="fa-solid fa-trash"></i>
                            Elminar Seleccionados
                        </button> -->
                    </div>

                    <!-- FONDO AGREGAR -->
                    <div id="ModalAgregar"
                        class="fixed inset-0 bg-black/70 flex items-center z-50 opacity-0 pointer-events-none transition-opacity duration-500">
                        <!-- MODAL -->
                        <form method="POST" class="bg-white w-1/2 mx-auto p-15 rounded-lg">
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
                            <div class="flex flex-col w-3/4 mx-auto text-lg">
                                <input name="agregar" class="hidden" readonly>
                                <label class="mb-3">Nombre:</label>
                                <input name="txt_nombre"
                                    class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                    type="text" placeholder="Ingrese su Nombre">
                                <label class="mb-3">Apellido:</label>
                                <input name="txt_apellido"
                                    class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                    type="text" placeholder="Ingrese su Apellido">
                                <label class="mb-3">Direccion:</label>
                                <input name="txt_direccion"
                                    class="border rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                    type="text" placeholder="e.j. Av. Ejemplo / Urb. Ejemplo">
                                <label class="mb-3">Email:</label>
                                <input name="txt_email"
                                    class="border  rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                    type="text" placeholder="example@gmail.com">
                                <label class="mb-3">Telefono:</label>
                                <input name="txt_telefono"
                                    class="border  rounded px-4 py-2 mb-5 transition focus:scale-105 focus:shadow-lg"
                                    type="text" placeholder="Numero de Telefono">
                            </div>
                            <div class="text-lg text-white flex justify-center items-center mt-5">
                                <input
                                    class="m-2 bg-green-500 hover:bg-green-400 p-4 rounded-lg cursor-pointer transition hover:shadow-lg hover:-translate-y-1 hover:scale-110"
                                    type="submit" value="Agregar">
                                <button id="btnCancelar" type="button"
                                    class="m-2 bg-red-400 hover:bg-red-300 p-4 rounded-lg cursor-pointer transition hover:shadow-lg hover:-translate-y-1 hover:scale-110">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- FONDO EDITAR -->
                    <div id="ModalEditar"
                        class="fixed inset-0 bg-black/70 flex items-center z-50 transition-opacity pointer-events-none opacity-0 duration-500">
                        <!-- MODAL -->
                        <form method="POST" class="bg-white w-1/2 mx-auto p-15 rounded-lg ">
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
                            <div class="flex flex-col w-3/4 mx-auto ">
                                <label class="mb-3">ID:</label>
                                <input class="border rounded px-4 py-2 mb-5" type="text" readonly
                                    value="<?php echo $id ?>">
                                <input name="editar" class="hidden" readonly>
                                <label class="mb-3">Nombre:</label>
                                <input name="txt_nombre" class="border rounded px-4 py-2 mb-5" type="text"
                                    placeholder="Ingrese su Nombre" value="<?php echo $nombre ?>">
                                <label class="mb-3">Apellido:</label>
                                <input name="txt_apellido" class="border rounded px-4 py-2 mb-5" type="text"
                                    placeholder="Ingrese su Apellido" value="<?php echo $apellido ?>">
                                <label class="mb-3">Direccion:</label>
                                <input name="txt_direccion" class="border rounded px-4 py-2 mb-5" type="text"
                                    placeholder="e.j. Av. Ejemplo / Urb. Ejemplo" value="<?php echo $direccion ?>">
                                <label class="mb-3">Email:</label>
                                <input name="txt_email" class="border  rounded px-4 py-2 mb-5" type="text"
                                    placeholder="example@gmail.com" value="<?php echo $email ?>">
                                <label class="mb-3">Telefono:</label>
                                <input name="txt_telefono" class="border  rounded px-4 py-2 mb-5" type="text"
                                    placeholder="Numero de Telefono" value="<?php echo $telefono ?>">
                            </div>
                            <div class="text-white flex justify-center items-center mt-5">
                                <input class="m-2 bg-green-500 hover:bg-green-400 p-3 rounded-lg cursor-pointer"
                                    type="submit" value="Editar">
                                <button id="btnCancelarE" type="button"
                                    class="m-2 bg-red-400 hover:bg-red-300 p-3 rounded-lg cursor-pointer">
                                    Cancelar
                                </button>
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
                    <form method="POST" action="">
                        <table class="w-full">
                            <thead>
                                <tr class="border-y m-3 text-lg">
                                    <th class="p-4"><input class='accent-sky-700 scale-150  ml-2' type="checkbox"
                                            value="">
                                    </th>
                                    <th class="p-4">ID</th>
                                    <th class="p-4">Nombre</th>
                                    <th class="p-4">Apellido</th>
                                    <th class="p-4">Direccion</th>
                                    <th class="p-4">Email</th>
                                    <th class="p-4">Telefono</th>
                                    <th class="p-4">Fecha de Registro</th>
                                    <th class="p-4">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $enlace->prepare("SELECT id_cliente,nom_cliente, ape_cliente, dir_cliente, email_cliente, tel_cliente, freg_cliente FROM tb_clientes");
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($id, $nombre, $apellido, $direccion, $email, $telefono, $fecha);
                                while ($stmt->fetch()) {
                                    echo "<tr class='border-y px-4 py-2 text-center'>";
                                    echo "<td><input name='ids[]' class='checkbox accent-blue-600 scale-150 ml-2' type='checkbox' value='" . $id . "'></td>";
                                    echo "<td class='p-5'>" . $id . "</td>";
                                    echo "<td class='p-5'>" . $nombre . "</td>";
                                    echo "<td class='p-5'>" . $apellido . "</td>";
                                    echo "<td class='p-5'>" . $direccion . "</td>";
                                    echo "<td class='p-5'>" . $email . "</td>";
                                    echo "<td class='p-5'>" . $telefono . "</td>";
                                    echo "<td class='p-5'>" . $fecha . "</td>";
                                    echo "<td class='flex items-center text-white justify-center'>
                                    <a href='cliente.php?id=" . $id . "&m=2' class='m-2 transition bg-blue-500 hover:bg-blue-600 hover:shadow-lg p-3 rounded-lg'>
                                        <i class='fa-solid fa-pen mr-3'></i>Editar
                                    </a>
                                    <a href='cliente.php?id=" . $id . "&d=1' onclick=\"return confirm('¿Seguro que deseas eliminar este cliente?');\" class='m-2 transition hover:shadow-lg bg-red-500 hover:bg-red-600 p-3 rounded-lg cursor-pointer'>
                                        <i class='fa-solid fa-trash mr-3'></i>Eliminar
                                    </a>
                                    </td>";
                                    echo "</tr>";
                                }
                                ?>
                                <!-- GET -->
                            </tbody>
                        </table>
                        <!-- POST -->
                        <button id="btnEliminarTodos" type="submit"
                            onclick="return confirm('Estas seguro que deseas borrar las filas seleccionadas?')"
                            class="hidden mr-10 my-4 text-white text-lg bg-red-500 p-3 rounded-lg cursor-pointer hover:shadow-lg transition ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-red-600">
                            <i class="fa-solid fa-trash"></i>
                            Elminar Seleccionados
                        </button>
                    </form>
                    <!-- FORM -->
                </div>
            </div>
            <?php
            include_once("../includes/footer.php");
            ?>
        </div>
    </div>
</body>

</html>