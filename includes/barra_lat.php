<div class="bg-sky-800 flex flex-col z-40">

    <a href="inicio.php"
        class="p-5 text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg">
        <i class="fa-solid fa-house mr-2"></i>
        Inicio
    </a>
    <a href="cliente.php"
        class="p-5 w-full text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg">
        <i class="fa-solid fa-users mr-2"></i>
        Clientes
    </a>
    <button id="btnInventario" type="button"
        class="p-5 w-full text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg flex justify-between items-center cursor-pointer">
        <!-- onclick="document.getElementById('btnProductos').classList.toggle('hidden'); document.getElementById('icono').classList.toggle('fa-caret-down');"> -->
        <div>
            <i class="fa-solid fa-cart-shopping mr-2"></i>
            Inventario
        </div>
        <i id="icono" class="fa-solid fa-caret-right"></i>
    </button>
    <div id="btnProductos" class="w-full text-gray-100 hidden flex flex-col bg-sky-700 ">
        <a href="producto.php"
            class="py-3 pl-3 pr-2 hover:bg-sky-400 transition rounded-lg my-1 mx-2 flex justify-between items-center text-sm">
            Productos
            <i class="fa-solid fa-circle-plus"></i>
        </a>
        <a href="categoria.php"
            class="py-3 pl-3 pr-2 hover:bg-sky-400 transition rounded-lg my-1 mx-2 flex justify-between items-center text-sm">
            Categoría
            <i class="fa-solid fa-circle-plus"></i>
        </a>
        <a href="subcategoria.php"
            class="py-3 pl-3 pr-2 hover:bg-sky-400 transition-color rounded-lg my-1 mx-2 flex justify-between items-center text-sm">
            Sub Categoría
            <i class="fa-solid fa-circle-plus"></i>
        </a>
    </div>
    <a href="#"
        class="p-5 w-full text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg">
        <i class="fa-solid fa-money-bill mr-2"></i>
        Ventas
    </a>
    <a href="#"
        class="p-5 w-full text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg">
        <i class="fa-solid fa-box-open mr-2"></i>
        Compras
    </a>
    <a href="#"
        class="p-5 w-full text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg">
        <i class="fa-solid fa-user-tie mr-2"></i>
        Usuario
    </a>
    <a href="#"
        class="p-5 w-full text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg">
        <i class="fa-solid fa-arrow-trend-up mr-2"></i>
        Reportes
    </a>
    <a href="#"
        class="p-5 w-full text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg">
        <i class="fa-solid fa-gear mr-2"></i>
        Configuracion
    </a>
    <a href="../login/logout.php"
        class="p-5 w-full text-gray-100 transition hover:bg-sky-400 rounded-lg m-2 hover:scale-110 hover:translate-x-5 hover:shadow-lg">
        <i class="fa-solid fa-right-from-bracket mr-2"></i>
        Cerrar Sesión
    </a>
</div>