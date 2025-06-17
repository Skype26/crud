<div class="bg-gray-600 flex flex-col w-60">

    <a href="inicio.php" class="p-5 w-full text-gray-100 hover:bg-gray-400">
        <i class="fa-solid fa-house mr-2"></i>
        Inicio
    </a>
    <a href="cliente.php" class="p-5 w-full text-gray-100 hover:bg-gray-400">
        <i class="fa-solid fa-users mr-2"></i>Clientes</a>
    <div href="producto.php" class="p-5 w-full text-gray-100 hover:bg-gray-400 flex justify-between items-center cursor-pointer"
        onclick="document.getElementById('btnProductos').classList.toggle('hidden'); document.getElementById('icono').classList.toggle('fa-caret-down');">
        <div>
            <i class="fa-solid fa-cart-shopping mr-2"></i>
            Inventario
        </div>
        <i id="icono" class="fa-solid fa-caret-right"></i>
    </div>
    <div id="btnProductos" class="w-full text-gray-100 hidden flex flex-col bg-gray-700">
        <a href="producto.php" class="pl-10 py-5 pr-5 hover:bg-gray-400">Productos</a>
        <a href="categoria.php" class="pl-10 py-5 pr-5 hover:bg-gray-400">Categoría</a>
        <a href="subcategoria.php" class="pl-10 py-5 pr-5 hover:bg-gray-400">Sub Categoría</a>
    </div>
    <a href="#" class="p-5 w-full text-gray-100 hover:bg-gray-400">Ventas</a>
    <a href="#" class="p-5 w-full text-gray-100 hover:bg-gray-400">Compras</a>
    <a href="#" class="p-5 w-full text-gray-100 hover:bg-gray-400">Usuario</a>
    <a href="#" class="p-5 w-full text-gray-100 hover:bg-gray-400">Reportes</a>
    <a href="#" class="p-5 w-full text-gray-100 hover:bg-gray-400">
        <i class="fa-solid fa-gear mr-2"></i>Configuracion</a>
    <a href="../login/logout.php" class="p-5 w-full text-gray-100 hover:bg-gray-400">
        <i class="fa-solid fa-right-from-bracket mr-2"></i>Cerrar Sesión</a>
</div>