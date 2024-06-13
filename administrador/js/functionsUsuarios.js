$("#usuarios").DataTable();

var tables;

document.addEventListener('DOMContentLoaded', function() {
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

function submitForm() {
    var formUsuario = document.querySelector('#formulario');
    var idusuario = document.querySelector('#idusuario').value;
    var nombre = document.querySelector('#Nombre').value;
    var apellido_paterno = document.querySelector('#Apellido_Paterno').value;
    var apellido_materno = document.querySelector('#Apellido_Materno').value;
    var nombre_usuario = document.querySelector('#nombre_usuario').value;
    var contraseña = document.querySelector('#contraseña').value;
    var tipo_usuario = document.querySelector('#tipo_usuario').value;
    var id_rol = document.querySelector('#id_rol').value;
    var info_contacto = document.querySelector('#info_contacto').value;
    var especialidad = document.querySelector('#especialidad').value;
    var Est_Reg = document.querySelector('#est_reg').value;

    if (nombre == '' || apellido_paterno == '' || apellido_materno == '' || nombre_usuario == '' || tipo_usuario == '' || id_rol == '') {
        swal("Atención", "Todos los campos son necesarios", "error");
        return false;
    }

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/usuarios/ajax-usuarios.php';
    var form = new FormData(formUsuario);
    request.open('POST', url, true);
    request.send(form);
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                $('#modalUsuario').modal('hide');
                formUsuario.reset();
                swal('Usuario', data.msg, 'success');
                tables.ajax.reload();
            } else {
                swal('Usuario', data.msg, 'error');
            }
        }
    }
}

function openModal() {
    document.querySelector('#idusuario').value = ''
    document.querySelector('#modal').innerHTML = 'Nuevo Usuario'
    document.querySelector('#action').innerHTML = 'Guardar'
    document.querySelector('#formulario').reset();
    $("#modalUsuario").modal('show');
}

function editarUsuario(ID) {
    var idusuario = ID;
    console.log(idusuario);

    document.querySelector('#modal').innerHTML = 'Actualizar Usuario'
    document.querySelector('#action').innerHTML = 'Actualizar'

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/usuarios/edit-usuarios.php?idusuario='+idusuario;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idusuario').value = data.data.ID;
                document.querySelector('#Nombre').value = data.data.Nombre;
                document.querySelector('#Apellido_Paterno').value = data.data.Apellido_Paterno;
                document.querySelector('#Apellido_Materno').value = data.data.Apellido_Materno;
                document.querySelector('#nombre_usuario').value = data.data.nombre_usuario;
                document.querySelector('#tipo_usuario').value = data.data.tipo_usuario;
                document.querySelector('#est_reg').value = data.data.Est_Reg;

                $("#modalUsuario").modal('show');

            } else {
                swal('Usuario', data.msg, 'error');
            }
        }
    }
}
