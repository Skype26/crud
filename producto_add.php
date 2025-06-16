<?php
include_once './conexion/cone.php';
?>


<!DOCTYPE html>
<html lang="es">

    <?php
    include_once './include/head.php';
    ?>
    <body>
        <?php
        include_once './include/header.php';
        ?>
        <br>
        <div class="content">
            <div class="container-fluid text-center mt-6">

                <div class="d-flex justify-content-between aling-items-center" style="paddingtop: 30px">
                    <h3 class="mb-0">Producto: Agregar Datos</h3>
                </div>
                <br>

                <?php
                $nombre = isset($_POST['txtNombre']) ? trim($_POST['txtNombre']) : '';
                $descripcion = isset($_POST['txtDescripcion']) ? trim($_POST['txtDescripcion']) : '';
                $modo = isset($_POST['txtModo']) ? trim($_POST['txtModo']) : '';
                $categoria = isset($_POST['txtCategoria']) ? trim($_POST['txtCategoria']) : '';
                $subcategoria = isset($_POST['txtSubcategoria']) ? trim($_POST['txtSubcategoria']) : '';
                $precio = isset($_POST['txtPrecio']) ? trim($_POST['txtPrecio']) : '';
                $stock = isset($_POST['txtStock']) ? trim($_POST['txtStock']) : '';


                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (!empty($nombre) && !empty($descripcion) && !empty($modo) && !empty($categoria) && !empty($subcategoria) && !empty($precio) && !empty($stock)) {

                        $sql = "insert into productoa (nomb_prod, desc_prod, mode_prod, cate_prod, subc_prod, prec_prod, stoc_prod)"
                                . "value (?,?,?,?,?,?,?)";
                        if ($stm = $con->prepare($sql)) {
                            $stm->bind_param('sssssss', $nombre, $descripcion, $modo, $categoria, $subcategoria, $precio, $stock);
                        }
                        if ($stm->execute()) {
                            echo "<div class='alert alert-success alert-dismissable'>"
                            . "<button type='button' class='btn-close' data-dismiss='alert' "
                                    . "aria-hidden='true'>&times</button>Datos Guardados con éxito</div>";
                        } else {
                            echo "<div class='alert alert-danger alert-dismissable'>"
                            . "<button type='button' class='close' data-dismiss='alert' "
                                    . "aria-hidden='true'>&times</button>No se Guardaron los Datos</div>";
                        }
                        $stm->close();
                    } else {
                        echo "Error al preparar la consulta". htmlspecialchars($con->error);
                    }
                } else {
                    echo "<div class='alert alert-warning'>Por favor completar todos los campos</div>";
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="txtNombre">Nombre</label>
                        <input type="text" name="txtNombre" id="txtNombre" class="form-control" 
                               placeholder="Ingrese su nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="txtDescripcion">Descripción</label>
                        <input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control" 
                               placeholder="Ingrese la descripción" required>
                    </div>
                    <div class="form-group">
                        <label for="txtModo">Modelo</label>
                        <input type="text" name="txtModo" id="txtModo" class="form-control" 
                               placeholder="Ingrese el modelo" required>
                    </div>
                    <div class="form-group">
                        <label for="txtCategoria">Categoría</label>
                        <input type="text" name="txtCategoria" id="txtCategoria" class="form-control" 
                               placeholder="Ingrese la categoría" required>
                    </div>
                    <div class="form-group">
                        <label for="txtSubcategoria">Subcategoría</label>
                        <input type="text" name="txtSubcategoria" id="txtSubcategoria" class="form-control" 
                               placeholder="Ingrese la subcategoría" required>
                    </div>
                    <div class="form-group">
                        <label for="txtPrecio">Precio</label>
                        <input type="number" name="txtPrecio" id="txtPrecio" class="form-control" 
                               placeholder="Ingrese el precio" required>
                    </div>
                    <div class="form-group">
                        <label for="txtStock">Stock</label>
                        <input type="number" name="txtStock" id="txtStock" class="form-control" 
                               placeholder="Ingrese el stock" required>
                    </div>
                    
                    <div class="form-buttons">
                        <button href="#" type="submit" name="btnAdd" class="btn btn-primary"><i class="fa fa-floppy-o"></i>Guardar Datos</button>
                        <a href="productos.php" class="btn btn-danger"><i class="fa fa-ban"></i>Cancelar</a>
                    </div>
                </form>
            </div>

        </div>

            <?php
include_once './include/footer.php';
?>
    </body>
</html>