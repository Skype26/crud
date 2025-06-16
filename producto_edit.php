<?php
include_once './conexion/cone.php';
?>


<!DOCTYPE html>
<html lang="es">
    <?php include_once './include/head.php'; ?>
    <body>
        <?php include_once './include/header.php'; ?>
        <br>
        <div class="content">
            <div class="container-fluid text-center mt-6">

                <div class="d-flex justify-content-between aling-items-center" style="paddingtop: 30px">
                    <h3 class="mb-0">Producto: Editar Datos</h3>
                </div>

                <h3>Editar Producto</h3>
                <?php
                $producto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                $nombre = $descripcion = $modo = $categoria = $subcategoria = $precio = $stock = "";

                if ($producto_id > 0) {
                    $stmt = $con->prepare("SELECT nomb_prod, desc_prod, mode_prod, cate_prod, subc_prod, prec_prod, stoc_prod FROM productoa WHERE codi_prod = ?");
                    $stmt->bind_param("i", $producto_id);
                    $stmt->execute();
                    $stmt->bind_result($nombre, $descripcion, $modo, $categoria, $subcategoria, $precio, $stock);
                    $stmt->fetch();
                    $stmt->close();
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnUpdate'])) {
                    $id = intval($_POST['producto_id']);
                    $nombre = trim($_POST['txtNombre']);
                    $descripcion = trim($_POST['txtDescripcion']);
                    $modo = trim($_POST['txtModo']);
                    $categoria = trim($_POST['txtCategoria']);
                    $subcategoria = trim($_POST['txtSubcategoria']);
                    $precio = trim($_POST['txtPrecio']);
                    $stock = trim($_POST['txtStock']);

                    if (!empty($nombre) && !empty($descripcion) && !empty($modo) && !empty($categoria) && !empty($subcategoria) && !empty($precio) && !empty($stock)) {
                        $sql = "UPDATE productoa SET nomb_prod=?, desc_prod=?, mode_prod=?, cate_prod=?, subc_prod=?, prec_prod=?, stoc_prod=? WHERE codi_prod=?";
                        if ($stm = $con->prepare($sql)) {
                            $stm->bind_param('ssssssii', $nombre, $descripcion, $modo, $categoria, $subcategoria, $precio, $stock, $id);
                            if ($stm->execute()) {
                                echo "<div class='alert alert-success'>Datos actualizados con éxito</div>";
                            } else {
                                echo "<div class='alert alert-danger'>No se pudieron actualizar los datos</div>";
                            }
                            $stm->close();
                        } else {
                            echo "Error en prepare(): " . $con->error;
                        }
                    } else {
                        echo "<div class='alert alert-warning'>Por favor completa todos los campos</div>";
                    }
                }
                ?>

                <?php if ($producto_id > 0): ?>

                    <form method="POST" action="">
                        <input type="hidden" name="producto_id" value="<?= $producto_id ?>">

                        <div class="form-group">
                            <label for="txtNombre">Nombre</label>
                            <input type="text" name="txtNombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">Descripción</label>
                            <input type="text" name="txtDescripcion" class="form-control" value="<?= htmlspecialchars($descripcion) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtModo">Modelo</label>
                            <input type="text" name="txtModo" class="form-control" value="<?= htmlspecialchars($modo) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtCategoria">Categoría</label>
                            <input type="text" name="txtCategoria" class="form-control" value="<?= htmlspecialchars($categoria) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtSubcategoria">Subcategoría</label>
                            <input type="text" name="txtSubcategoria" class="form-control" value="<?= htmlspecialchars($subcategoria) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtPrecio">Precio</label>
                            <input type="number" name="txtPrecio" class="form-control" value="<?= htmlspecialchars($precio) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtStock">Stock</label>
                            <input type="number" name="txtStock" class="form-control" value="<?= htmlspecialchars($stock) ?>" required>
                        </div>
                        <button type="submit" name="btnUpdate" class="btn btn-primary">Guardar Cambios</button>
                        <a href="productos.php" class="btn btn-success">Volver a Productos</a>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning">No se ha seleccionado ningún producto válido para editar.</div>
                <?php endif; ?>
            </div>

        </div>
    </body>
    <?php include_once './include/footer.php'; ?>
</html>