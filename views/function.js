$(document).ready(function () {
    const params = new URLSearchParams(window.location.search);
    if (params.get("m") === '1') {
        $("#ModalAgregar").removeClass("opacity-0 pointer-events-none");
        $("#ModalAgregar").addClass("opacity-100");
        $("body").toggleClass("overflow-hidden");
    }
    if (params.get('m') === '2') {
        $("#ModalEditar").removeClass("opacity-0 pointer-events-none");
        $("#ModalEditar").addClass("opacity-100");
        $("body").toggleClass("overflow-hidden");
    }
    $("#btnCancelar").click(function () {
        window.location.href = "cliente.php";
    });
    $("#btnCancelarE").click(function () {
        window.location.href = "cliente.php";
    });
    $("#btnAgregar").click(function () {
        //APARECE
        $("#ModalAgregar").removeClass("opacity-0 pointer-events-none");
        $("#ModalAgregar").addClass("opacity-100");
        $("body").toggleClass("overflow-hidden");
    });
    $("#btnInventario").click(function () {
        $("#btnProductos").toggleClass("hidden");
        $("#icono").toggleClass("fa-caret-down");
    });
    $(".checkbox").on('change',function(){
        if($(".checkbox:checked").length > 0){
            $("#btnEliminarTodos").removeClass("hidden");
            $("#lista").addClass("hidden");
            $("#seleccion").removeClass("hidden");
        } else{
            $("#btnEliminarTodos").addClass("hidden");
            $("#lista").removeClass("hidden");
            $("#seleccion").addClass("hidden");
        }
    });
});