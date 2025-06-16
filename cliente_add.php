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
                    <h3 class="mb-0">Cliente: Agregar Datos</h3>
                </div>
                <br>

                <?php
                $nombre = isset($_POST['txtNombre']) ? trim($_POST['txtNombre']) : '';
                $apellido = isset($_POST['txtApellido']) ? trim($_POST['txtApellido']) : '';
                $direccion = isset($_POST['txtDir']) ? trim($_POST['txtDir']) : '';
                $correo = isset($_POST['txtCorreo']) ? trim($_POST['txtCorreo']) : '';
                $telefono = isset($_POST['txtTel']) ? trim($_POST['txtTel']) : '';
                $freg = isset($_POST['txtFreg']) ? trim($_POST['txtFreg']) : '';
                //capturar fecha de del sistema
                $fecha_actual = date('Y-m-d H:i:s'); // Formato de fecha y hora

                

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (!empty($nombre) && !empty($apellido) && !empty($direccion) && !empty($correo) && !empty($telefono) && !empty($fecha_actual)) {

                        $sql = "insert into cliente (nomb_clie, apel_clie, dire_clie, "
                                . " tele_clie,corr_clie, fech_clie)"
                                . "value (?,?,?,?,?,?)";
                        if ($stm = $con->prepare($sql)) {
                            $stm->bind_param('ssssss', $nombre, $apellido, $direccion,  $telefono,$correo, $fecha_actual);
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
                        <label for="txtNombre">Nombres</label>
                        <input type="text" name="txtNombre" id="txtNombre" class="form-control" 
                               placeholder="Ingrese su nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="txtApellido">Apellidos</label>
                        <input type="text" name="txtApellido" id="txtApellido" class="form-control" 
                               placeholder="Ingrese sus apellidos" required>
                    </div>
                    <div class="form-group">
                        <label for="txtDir">Dirección</label>
                        <input type="text" name="txtDir" id="txtDir" class="form-control" 
                               placeholder="Ingrese su dirección" required>
                    </div>
                    <div class="form-group">
                        <label for="txtCorreo">Correo</label>
                        <input type="text" name="txtCorreo" id="txtCorreo" class="form-control" 
                               placeholder="Ingrese su correo" required>
                    </div>
                    <div class="form-group">
                        <label for="txtTel">Telefono</label>
                        <input type="text" name="txtTel" id="txtTel" class="form-control" 
                               placeholder="Ingrese su Telefono" required>
                    </div>
                    
                    <div class="form-buttons">
                        <a href="admin.php" type="submit" name="btnAdd" class="btn btn-primary"><i class="fa fa-floppy-o"></i>Guardar Datos</a>
                        <a href="admin.php" class="btn btn-danger"><i class="fa fa-ban"></i>Cancelar</a>
                    </div>
                </form>
            </div>
            <?php
include_once './include/footer.php';
?>
        </div>


    </body>
</html>