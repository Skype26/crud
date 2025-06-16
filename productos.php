<?php
    include_once './conexion/cone.php';
    if(!$con){
        die("Error de conexion: " .mysqli_connect_error());
    }


    $sql= "SELECT * FROM productoa";
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
                    <h3 class="mb-0">Listado de Productos</h3>
                    <a href="producto_add.php" class="btn btn-success">Agregar</a>
                </div>
                <br>
                <table class="table table-bordered text-center table-hover" style="width: 100%;">
                    <thead>
                        <th style="text-align: center;">Codigo</th>
                        <th style="text-align: center;">Nombre</th>
                        <th style="text-align: center;">Descripcion</th>
                        <th style="text-align: center;">Modelo</th>
                        <th style="text-align: center;">Categoria</th>
                        <th style="text-align: center;">Subcategoria</th>
                        <th style="text-align: center;">Precio</th>
                        <th style="text-align: center;">Stock</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['codi_prod'] . "</td>";
                            echo "<td>" . $row['nomb_prod'] . "</td>";
                            echo "<td>" . $row['desc_prod'] . "</td>";
                            echo "<td>" . $row['mode_prod'] . "</td>";
                            echo "<td>" . $row['cate_prod'] . "</td>";
                            echo "<td>" . $row['subc_prod'] . "</td>";
                            echo "<td>" . $row['prec_prod'] . "</td>";
                            echo "<td>" . $row['stoc_prod'] . "</td>";

                            echo '<td>
                                    <a href="producto_edit.php?id=' . $row['codi_prod'] . '" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                                    <a href="producto_delete.php?id=' . $row['codi_prod'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
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