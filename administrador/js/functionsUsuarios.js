$("#users").DataTable

var users;
$(document).ready(function() {
    users = $('#users').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/usuarios/table_usuarios.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "Usuario_Id"},
            {"data": "Usuario_Nombre"},
            {"data": "RolNombre"},
            {"data": "Usuario_EstReg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });
});

function openModal() {
    $("#modalUsuario").modal('show');
}
