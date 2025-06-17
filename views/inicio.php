<?php
session_start();
include_once("../conexion/conexion.php");
include_once("../conexion/validar_sesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once("../includes/head.php");
?>

<body class="bg-gray-200">

    <?php
    include_once("../includes/barra_sup.php");
    ?>

    <div class="flex pt-25">
        <?php
        include_once("../includes/barra_lat.php");
        ?>

        <div class="flex-1 flex-col">
            <div class="h-screen p-10">
                <h1 class="text-3xl">
                    Bienvenido, <?php echo $_SESSION['usuario'] ?>🖖🏻
                </h1>
                <div class="my-10 h-0.5 bg-gray-400 rounded w-full"></div>
            </div>
            <?php
            include_once("../includes/footer.php");
            ?>
        </div>
    </div>
</body>

</html>