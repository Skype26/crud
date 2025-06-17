$(document).ready(function() {
    const params = new URLSearchParams(window.location.search);
    if (params.get('m') === '1') {
        $('#ModalAgregarCliente').toggleClass('hidden');
    }
    $("#btnCancelar").click(function(){
        window.location.href = "cliente.php";
    });
});