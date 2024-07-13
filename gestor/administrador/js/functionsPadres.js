$("#tablePadres").DataTable();
var tablePadres;

document.addEventListener('DOMContentLoaded', function() {
    tablePadres = $('#tablePadres').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/padres/table_padres.php",
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
            {"data": "tipo_usuario"},
            {"data": "id_rol"},
            {"data": "est_reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });


    var formPadre = document.querySelector('#formPadre');
    if (formPadre) {
        formPadre.onsubmit = function(e) {
            console.log("Si entra al formulario.onsubmit");
            e.preventDefault();

            var idpadre = document.querySelector('#idpadre').value;
            var nombre = document.querySelector('#nombre').value;
            var apellido_paterno = document.querySelector('#apellido_paterno').value;
            var apellido_materno = document.querySelector('#apellido_materno').value;
            var nombre_usuario = document.querySelector('#nombre_usuario').value;
            var contraseña = document.querySelector('#contraseña').value;
            var tipo_usuario = document.querySelector('#tipo_usuario').value;
            var id_rol = document.querySelector('#id_rol').value;
            var numero_contacto = document.querySelector('#numero_contacto').value;
            var info_contacto = document.querySelector('#info_contacto').value;
            var est_reg = document.querySelector('#est_reg').value;

            if (nombre == '' || apellido_paterno == '' || apellido_materno == '' || nombre_usuario == '' || tipo_usuario == '' || id_rol == '' || info_contacto == '' || numero_contacto == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios - functions',
                    icon: 'error'
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/padres/ajax-padres.php';
            var form = new FormData(formPadre);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalPadre').modal('hide');
                        formPadre.reset();
                        Swal.fire({
                            title: 'Usuario',
                            text: data.msg,
                            icon: 'success'
                        });
                        tablePadres.ajax.reload();
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

function openModalPadres() {
    document.querySelector('#idpadre').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Padre';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formPadre').reset();
    $("#modalPadre").modal('show');
}

function editarPadre(ID) {
    var idpadre = ID;
    console.log(idpadre);

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Padre'
    document.querySelector('#action').innerHTML = 'Actualizar'

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/padres/edit-padres.php?idpadre='+idpadre;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idpadre').value = data.data.id_usuario;
                document.querySelector('#nombre').value = data.data.nombre;
                document.querySelector('#apellido_paterno').value = data.data.apellido_paterno;
                document.querySelector('#apellido_materno').value = data.data.apellido_materno;
                document.querySelector('#nombre_usuario').value = data.data.nombre_usuario;
                document.querySelector('#numero_contacto').value = data.data.numero_contacto;
                document.querySelector('#tipo_usuario').value = data.data.tipo_usuario;
                document.querySelector('#info_contacto').value = data.data.info_contacto;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalPadre").modal('show');

            } else {
                Swal.fire({
                    title: 'Padre',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarPadre(ID){
    var idpadre = ID;

    Swal.fire({
        title: "Eliminar Padre",
        text: "¿Desea eliminar al Padre?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/padres/delete-padres.php';
            request.open('POST', url, true);
            var strData = "idpadre="+idpadre;
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);  // Add this line
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        Swal.fire({
                            title: 'Eliminar',
                            text: data.msg,
                            icon: 'success'
                        });
                        tablePadres.ajax.reload();
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