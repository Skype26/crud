<?php
    include_once './conexion/cone.php';
    if(!$con){
        die("Error de conexion: " .mysqli_connect_error());
    }


    $sql= "SELECT * FROM cliente";
    $result = mysqli_query($con, $sql);
    if(!$result){
        die("Error al ejecutar la consulta: " .mysqli_connect_error());
    }

?>
<!DOCTYPE html>
<html lang="es">

<?php
include_once './include/head.php';
?>

<body style="position: relative; min-height: 100vh; overflow-x: hidden;">
    
        <?php include_once './include/header.php'; ?>
        
        <div class="content">
            <div class="container-fluid text-center mt-6">
                <div class="d-flex justify-content-between align-items-center" style="padding: 30px;">
                    <h3 class="mb-0">Listado de Clientes</h3>
                    <a href="cliente_add.php" class="btn btn-success">Agregar</a>
                </div>
                <br>
                <table class="table table-bordered text-center table-hover" style="width: 100%;">
                    <thead>
                        <th style="text-align: center;">Codigo</th>
                        <th style="text-align: center;">Nombre</th>
                        <th style="text-align: center;">Apellido</th>
                        <th style="text-align: center;">Direccion</th>
                        <th style="text-align: center;">telefono</th>
                        <th style="text-align: center;">Correo</th>
                        <th style="text-align: center;">Fecha</th>
                        <th style="text-align: center;">Opciones</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['id_clie'] . "</td>";
                            echo "<td>" . $row['nomb_clie'] . "</td>";
                            echo "<td>" . $row['apel_clie'] . "</td>";
                            echo "<td>" . $row['dire_clie'] . "</td>";
                            echo "<td>" . $row['tele_clie'] . "</td>";
                            echo "<td>" . $row['corr_clie'] . "</td>";
                            echo "<td>" . $row['fech_clie'] . "</td>";

                            echo '<td>
                                    <a href="cliente_edit.php?id=' . $row['id_clie'] . '" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                                    <a href="cliente_delete.php?id=' . $row['id_clie'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
                                  </td>';

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include_once './include/footer.php'; ?>
    </div>
</body>

</html>