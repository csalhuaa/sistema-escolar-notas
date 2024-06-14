$('#tableProfesores').DataTable();
var tableProfesores;

document.addEventListener('DOMContentLoaded', function() {
    // Inicializa DataTable
    tableProfesores = $('#tableProfesores').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/profesores/table_profesores.php",
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
            {"data": "id_rol"},
            {"data": "especialidad"},
            {"data": "Est_Reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    
    var formProfesor = document.querySelector('#formProfesor');
    formProfesor.onsubmit = function(e) {
        e.preventDefault();

<<<<<<< HEAD
=======
        // var formUsuario = document.querySelector('#formulario');
>>>>>>> 1b3c3f534f844a8532a401a3bf81853f1b61d016
        var idprofesor = document.querySelector('#idprofesor').value;
        var nombre = document.querySelector('#Nombre').value;
        var apellido_paterno = document.querySelector('#Apellido_Paterno').value;
        var apellido_materno = document.querySelector('#Apellido_Materno').value;
        var nombre_usuario = document.querySelector('#nombre_usuario').value;
        var contraseña = document.querySelector('#contraseña').value;
<<<<<<< HEAD
        var info_contacto = document.querySelector('#info_contacto').value;
        var tipo_usuario = document.querySelector('#tipo_usuario').value;
        var id_rol = document.querySelector('#id_rol').value;
=======
        var tipo_usuario = document.querySelector('#tipo_usuario').value;
        var id_rol = document.querySelector('#id_rol').value;
        var info_contacto = document.querySelector('#info_contacto').value;
>>>>>>> 1b3c3f534f844a8532a401a3bf81853f1b61d016
        var especialidad = document.querySelector('#especialidad').value;
        var Est_Reg = document.querySelector('#est_reg').value;

        if (nombre == '' || apellido_paterno == '' || apellido_materno == '' || nombre_usuario == '' || tipo_usuario == '' || id_rol == '') {
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
                if (request.status) {
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
});

function openModalProfesores() {
    document.querySelector('#idprofesor').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Profesor';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formProfesor').reset();
    $("#modalProfesor").modal('show');
}

function editarProfesor(ID) {
    var idprofesor = ID;

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
                document.querySelector('#idprofesor').value = data.data.ID;
                document.querySelector('#Nombre').value = data.data.Nombre;
                document.querySelector('#Apellido_Paterno').value = data.data.Apellido_Paterno;
                document.querySelector('#Apellido_Materno').value = data.data.Apellido_Materno;
                document.querySelector('#nombre_usuario').value = data.data.nombre_usuario;
<<<<<<< HEAD
                document.querySelector('#info_contacto').value = data.data.info_contacto;
                document.querySelector('#tipo_usuario').value = data.data.tipo_usuario;
                document.querySelector('#especialidad').value = data.data.especialidad;
                document.querySelector('#est_reg').value = data.data.Est_Reg;
=======
                // document.querySelector('#tipo_usuario').value = data.data.tipo_usuario;
                document.querySelector('#info_contacto').value = data.data.info_contacto;
                document.querySelector('#especialidad').value = data.data.especialidad;
                // document.querySelector('#est_reg').value = data.data.Est_Reg;
>>>>>>> 1b3c3f534f844a8532a401a3bf81853f1b61d016

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

function eliminarProfesor(ID){
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
            var strData = "idprofesor="+idprofesor;
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
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