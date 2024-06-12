$("#usuarios").DataTable();

var tables;

// let tableUsuarios = new DataTable('#tableUsuarios');
document.addEventListener('DOMContentLoaded', function(){
    tables = $('#usuarios').DataTable({
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
            {"data": "ID"},
            {"data": "Nombre"},
            {"data": "Apellido_Paterno"},
            {"data": "Apellido_Materno"},
            {"data": "nombre_usuario"},
            {"data": "info_contacto"},
            {"data": "tipo_usuario"},
            {"data": "Est_Reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });
});

var formUsuario = document.querySelector('#formulario');
formUsuario.onsubmit = function(e) {
    e.preventDefault();

    var nombre = document.querySelector('#nombre').value;
    var usuario = document.querySelector('#usuario').value;
    var contraseña = document.querySelector('#contraseña').value;
    var listRol = document.querySelector('#listRol').value;

    if(nombre == '' || usuario == '' || contraseña == ''){
        swal('Atención', 'Todos los campos son necesarios', 'error');
        return false;
    }

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/usuarios/ajax-usuarios.php';
    var form = new FormData(formUsuario);
    request.open('POST', url, true);
    request.send(form);
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.status == 200);
            if(request.status) {
                $('#modalUsuario').modal('hide');
                formUsuario.reset();
                swal('Usuario', data.msg, 'success')
                tables.ajax.reload();
            } else {
                swal('Usuario', data.msg, 'error')
            }
        }
    }
}

function openModal() {
    $("#modalUsuario").modal('show');
}
