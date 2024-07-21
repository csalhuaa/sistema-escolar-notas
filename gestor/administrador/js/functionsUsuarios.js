$('#tableUsuarios').DataTable();
var tableUsuarios;

document.addEventListener('DOMContentLoaded', function() {
    // Inicializa DataTable
    tableUsuarios = $('#tableUsuarios').DataTable({
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
            {"data": "id_usuario"},
            {"data": "nombre"},
            {"data": "apellido_paterno"},
            {"data": "apellido_materno"},
            {"data": "nombre_usuario"},
            {"data": "numero_contacto"},
            {"data": "info_contacto"},
            {"data": "nombre_rol"},
            {"data": "est_reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    
    var formUsuario = document.querySelector('#formUsuario');
    if (formUsuario) {
        formUsuario.onsubmit = function(e) {
            console.log("Si entra al formulario.onsubmit");
            e.preventDefault();

            // var formUsuario = document.querySelector('#formulario');
            var idusuario = document.querySelector('#idusuario').value;
            var nombre = document.querySelector('#nombre').value;
            var apellido_paterno = document.querySelector('#apellido_paterno').value;
            var apellido_materno = document.querySelector('#apellido_materno').value;
            var nombre_usuario = document.querySelector('#nombre_usuario').value;
            var contraseña = document.querySelector('#contraseña').value;
            var id_rol = document.querySelector('#id_rol').value;
            var info_contacto = document.querySelector('#info_contacto').value;
            var numero_contacto = document.querySelector('#numero_contacto').value;
            var est_reg = document.querySelector('#est_reg').value;

            if (nombre == '' || apellido_paterno == '' || apellido_materno == '' || nombre_usuario == '' || id_rol == '' || info_contacto == '' || numero_contacto == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios',
                    icon: 'error'
                });
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
                    if (request.status) {
                        $('#modalUsuario').modal('hide');
                        formUsuario.reset();
                        Swal.fire({
                            title: 'Usuario',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableUsuarios.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Usuario',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalUsuarios() {
    document.querySelector('#idusuario').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Usuario';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formUsuario').reset();
    $("#modalUsuario").modal('show');
}

function editarUsuario(ID) {
    var idusuario = ID;
    console.log("ID: ", idusuario);
    document.querySelector('#tituloModal').innerHTML = 'Actualizar Usuario';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/usuarios/edit-usuarios.php?idusuario=' + idusuario;
    request.open('GET', url, true);
    request.send();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idusuario').value = data.data.id_usuario;
                document.querySelector('#nombre').value = data.data.nombre;
                document.querySelector('#apellido_paterno').value = data.data.apellido_paterno;
                document.querySelector('#apellido_materno').value = data.data.apellido_materno;
                document.querySelector('#nombre_usuario').value = data.data.nombre_usuario;
                document.querySelector('#numero_contacto').value = data.data.numero_contacto;
                document.querySelector('#info_contacto').value = data.data.info_contacto;
                document.querySelector('#id_rol').value = data.data.id_rol;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalUsuario").modal('show');
            } else {
                Swal.fire({
                    title: 'Usuario',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}


function eliminarUsuario(ID){
    var idusuario = ID;

    Swal.fire({
        title: "Eliminar Usuario",
        text: "¿Desea eliminar al Usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/usuarios/delete-usuarios.php';
            request.open('POST', url, true);
            var strData = "idusuario=" + idusuario;
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
    
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        Swal.fire({
                            title: 'Eliminar',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableUsuarios.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Atención',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    });    
}