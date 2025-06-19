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

    $(".checkbox").on('change', function () {
        if ($(".checkbox:checked").length > 0) {
            $("#seleccion").text(`${$(".checkbox:checked").length} Fila(s) Seleccionada(s)`);
            $("#tituloEliminarSeleccion").removeClass("hidden");
            $("#lista").addClass("hidden");
            $("#btnAgregar").addClass("hidden");
        } else {
            $("#tituloEliminarSeleccion").addClass("hidden");
            $("#lista").removeClass("hidden");
            $("#btnAgregar").removeClass("hidden");
        }

        if ($(".checkbox:checked").length === $(".checkbox").length) {
            $(".checkboxPadre").prop('checked', true);
        } else {
            $(".checkboxPadre").prop('checked', false);
        }
    });

    $(".checkboxPadre").on('change', function () {
        $(".checkbox").prop('checked', $(".checkboxPadre").prop('checked'));
        if ($(".checkboxPadre").prop('checked')) {
            $("#seleccion").text(`${$(".checkbox:checked").length} Fila(s) Seleccionada(s)`);
            $("#tituloEliminarSeleccion").removeClass("hidden");
            $("#lista").addClass("hidden");
            $("#btnAgregar").addClass("hidden");
            $(".fila").addClass("bg-gray-200");
            $(".fila").removeClass("hover:bg-gray-200");
            $(".fila").addClass("hover:bg-white");
        } else {
            $("#tituloEliminarSeleccion").addClass("hidden");
            $("#btnAgregar").removeClass("hidden");
            $("#lista").removeClass("hidden");
            $(".fila").removeClass("bg-gray-200");
            $(".fila").addClass("hover:bg-gray-200");
            $(".fila").removeClass("hover:bg-white");
        }
    });
});