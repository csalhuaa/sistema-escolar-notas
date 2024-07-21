$('#tableProfesores').DataTable();
var tableProfesores;

document.addEventListener('DOMContentLoaded', function() {
    tableProfesores = $('#tableProfesores').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/profesores/table_profesores.php",
            "dataSrc": ""
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
            {"data": "est_reg"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formProfesor = document.querySelector('#formProfesor');
    if (formProfesor) {
        formProfesor.onsubmit = function(e) {
            e.preventDefault();

            var idprofesor = document.querySelector('#idprofesor').value;
            var nombre = document.querySelector('#nombre').value;
            var apellido_paterno = document.querySelector('#apellido_paterno').value;
            var apellido_materno = document.querySelector('#apellido_materno').value;
            var nombre_usuario = document.querySelector('#nombre_usuario').value;
            var contraseña = document.querySelector('#contraseña').value;
            var id_rol = document.querySelector('#id_rol').value;
            var info_contacto = document.querySelector('#info_contacto').value;
            var numero_contacto = document.querySelector('#numero_contacto').value;
            var Est_Reg = document.querySelector('#est_reg').value;

            if (nombre == '' || apellido_paterno == '' || apellido_materno == '' || nombre_usuario == '' || id_rol == '' || info_contacto == '' || numero_contacto == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios',
                    icon: 'error'
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/profesores/ajax-profesores.php';
            var form = new FormData(formProfesor);

            request.open('POST', url, true);
            request.send(form);

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalProfesor').modal('hide');
                        formProfesor.reset();
                        Swal.fire({
                            title: 'Profesor',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableProfesores.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Profesor',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalProfesores() {
    document.querySelector('#idprofesor').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Profesor';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formProfesor').reset();
    $("#modalProfesor").modal('show');
}

window.addEventListener('load', function() {
    showCursos();
}, false);

function showCursos() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/optionsCursos.php';

    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="' + valor.id_curso + '">' + valor.nombre + '</option>';
            });
            var especialidad = document.querySelector('#especialidad');
            if (especialidad) {
                especialidad.innerHTML = data;
            }
        }
    }
}

function editarProfesor(ID) {
    var idprofesor = ID;
    console.log(idprofesor);

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Profesor';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/profesores/edit-profesores.php?idprofesor=' + idprofesor;
    request.open('GET', url, true);
    request.send();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idprofesor').value = data.data.id_usuario;
                document.querySelector('#nombre').value = data.data.nombre;
                document.querySelector('#apellido_paterno').value = data.data.apellido_paterno;
                document.querySelector('#apellido_materno').value = data.data.apellido_materno;
                document.querySelector('#nombre_usuario').value = data.data.nombre_usuario;
                document.querySelector('#numero_contacto').value = data.data.numero_contacto;
                document.querySelector('#info_contacto').value = data.data.info_contacto;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalProfesor").modal('show');
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

function eliminarProfesor(ID) {
    var idprofesor = ID;

    Swal.fire({
        title: "Eliminar Profesor",
        text: "¿Desea eliminar al Usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/profesores/delete-profesores.php';
            request.open('POST', url, true);
            var strData = "idprofesor=" + idprofesor;
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    console.log(request.responseText);  // Add this line
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        Swal.fire({
                            title: 'Eliminar',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableProfesores.ajax.reload();
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
    })
}
