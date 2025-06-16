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
                    <h3 class="mb-0">Cliente: Editar Datos</h3>
                </div>

                <h3>Editar Cliente</h3>
                <?php
                $cliente_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                $nombre = $apellido = $direccion = $correo = $telefono = $freg = "";

                if ($cliente_id > 0) {
                    $stmt = $con->prepare("SELECT nomb_clie, apel_clie, dire_clie, corr_clie, tele_clie FROM cliente WHERE id_clie = ?");
                    $stmt->bind_param("i", $cliente_id);
                    $stmt->execute();
                    $stmt->bind_result($nombre, $apellido, $direccion, $correo, $telefono);
                    $stmt->fetch();
                    $stmt->close();
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnUpdate'])) {
                    $id = intval($_POST['cliente_id']);
                    $nombre = trim($_POST['txtNombre']);
                    $apellido = trim($_POST['txtApellido']);
                    $direccion = trim($_POST['txtDir']);
                    $correo = trim($_POST['txtCorreo']);
                    $telefono = trim($_POST['txtTel']);
                    

                    if (!empty($nombre) && !empty($apellido) && !empty($direccion) && !empty($correo) && !empty($telefono)) {
                        $sql = "UPDATE cliente SET nomb_clie=?, apel_clie=?, dire_clie=?, corr_clie=?, tele_clie=? WHERE id_clie=?";
                        if ($stm = $con->prepare($sql)) {
                            $stm->bind_param('sssssi', $nombre, $apellido, $direccion, $correo, $telefono, $id);
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

                <?php if ($cliente_id > 0): ?>

                    <form method="POST" action="">
                        <input type="hidden" name="cliente_id" value="<?= $cliente_id ?>">

                        <div class="form-group">
                            <label for="txtNombre">Nombres</label>
                            <input type="text" name="txtNombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtApellido">Apellidos</label>
                            <input type="text" name="txtApellido" class="form-control" value="<?= htmlspecialchars($apellido) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtDir">Dirección</label>
                            <input type="text" name="txtDir" class="form-control" value="<?= htmlspecialchars($direccion) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtCorreo">Correo</label>
                            <input type="email" name="txtCorreo" class="form-control" value="<?= htmlspecialchars($correo) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="txtTel">Teléfono</label>
                            <input type="text" name="txtTel" class="form-control" value="<?= htmlspecialchars($telefono) ?>" required>
                        </div>
                        <button type="submit" name="btnUpdate" class="btn btn-primary">Guardar Cambios</button>
                        <a href="admin.php" class="btn btn-success">Volver a Clientes</a>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning">No se ha seleccionado ningún cliente válido para editar.</div>
                <?php endif; ?>
            </div>

            
    </body>
    <?php include_once './include/footer.php'; ?>
</html>