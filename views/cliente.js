$(document).ready(function () {
    const params = new URLSearchParams(window.location.search);
    if (params.get('m') === '1') {
        $("#ModalAgregar").removeClass("opacity-0 pointer-events-none");
        $("#ModalAgregar").addClass("opacity-100");
        $("body").toggleClass("overflow-hidden");
    }
    if (params.get('m') === '2') {
        $("#ModalEditar").removeClass("opacity-0 pointer-events-none");
        $("#ModalEditar").addClass("opacity-100");
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
});