$('#tableComunicados').DataTable();
var tableComunicados;

document.addEventListener('DOMContentLoaded', function() {
    tableComunicados = $('#tableComunicados').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/comunicados/table_comunicados.php",
            "dataSrc": ""
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_comunicado"},
            {"data": "titulo"},
            {"data": "asunto"},
            {"data": "fecha"},
            {"data": "nombre_rol"},
            {"data": "est_reg"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formComunicado = document.querySelector('#formComunicado');
    if (formComunicado) {
        formComunicado.onsubmit = function(e) {
            e.preventDefault();

            var idcomunicado = document.querySelector('#idcomunicado').value;
            var titulo = document.querySelector('#titulo').value;
            var asunto = document.querySelector('#asunto').value;
            var fecha = document.querySelector('#fecha').value;

            if (titulo == '' || asunto == '' || fecha == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios',
                    icon: 'error'
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/comunicados/ajax-comunicados.php';
            var form = new FormData(formComunicado);

            request.open('POST', url, true);
            request.send(form);

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalComunicado').modal('hide');
                        formComunicado.reset();
                        Swal.fire({
                            title: 'Comunicado',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableComunicados.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Comunicado',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalComunicado() {
    document.querySelector('#idcomunicado').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Comunicado';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formComunicado').reset();
    $("#modalComunicado").modal('show');
}

function editarComunicado(ID) {
    var idcomunicado = ID;
    console.log(idcomunicado);

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Comunicado';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/comunicados/edit-comunicados.php?idcomunicado=' + idcomunicado;
    request.open('GET', url, true);
    request.send();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {

                document.querySelector('#idcomunicado').value = data.data.id_comunicado;
                document.querySelector('#titulo').value = data.data.titulo;
                document.querySelector('#asunto').value = data.data.asunto;
                document.querySelector('#fecha').value = data.data.fecha;
                document.querySelector('#id_rol').value = data.data.id_rol;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalComunicado").modal('show');
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

function eliminarComunicado(ID) {
    var idcomunicado = ID;

    Swal.fire({
        title: "Eliminar Comunicado",
        text: "¿Desea eliminar al Usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/comunicados/delete-comunicados.php';
            request.open('POST', url, true);
            var strData = "idcomunicado=" + idcomunicado;
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
                        tableComunicados.ajax.reload();
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
