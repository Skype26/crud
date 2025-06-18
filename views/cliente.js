$(document).ready(function() {
    const params = new URLSearchParams(window.location.search);
    if (params.get('m') === '1') {
        $('#ModalAgregar').toggleClass('hidden');
    }
    if (params.get('m') === '2') {
        $('#ModalEditar').toggleClass('hidden');
    }
    $("#btnCancelar").click(function(){
        window.location.href = "cliente.php";
    });
    $("#btnCancelarE").click(function(){
        window.location.href = "cliente.php";
    });
});