$("#tableSecciones").DataTable();
var tableSecciones;

document.addEventListener('DOMContentLoaded', function() {
    tableSecciones = $('#tableSecciones').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/secciones/table_secciones.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_seccion"},
            {"data": "nombre_seccion"},
            {"data": "est_reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });


    var formSeccion = document.querySelector('#formSeccion');
    if (formSeccion) {
        formSeccion.onsubmit = function(e) {
            console.log("Si entra al formulario.onsubmit");
            e.preventDefault();

            var idseccion = document.querySelector('#idseccion').value;
            var nombre = document.querySelector('#Nombre').value;
            var est_reg = document.querySelector('#est_reg').value;

            if (nombre == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios',
                    icon: 'error'
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/secciones/ajax-secciones.php';
            var form = new FormData(formSeccion);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalSeccion').modal('hide');
                        formSeccion.reset();
                        Swal.fire({
                            title: 'Sección',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableSecciones.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Sección',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalSeccion() {
    document.querySelector('#idseccion').value = "";
    document.querySelector('#modalTitulo').innerHTML = 'Nuevo Sección';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formSeccion').reset();
    $("#modalSeccion").modal('show');
}


function editarSeccion(ID) {
    var idseccion = ID;
    console.log(idseccion);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Sección';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/secciones/edit-secciones.php?idseccion='+idseccion;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idseccion').value = data.data.id_seccion;
                document.querySelector('#Nombre').value = data.data.nombre_seccion;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalSeccion").modal('show');

            } else {
                Swal.fire({
                    title: 'Grado',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarSeccion(ID){
    var idseccion = ID;

    Swal.fire({
        title: "Eliminar Sección",
        text: "¿Desea eliminar al Sección?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/secciones/delete-secciones.php';
            request.open('POST', url, true);
            var strData = "idseccion="+idseccion;
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
                        tableSecciones.ajax.reload();
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