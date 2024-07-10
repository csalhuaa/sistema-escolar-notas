$("#tableGrados").DataTable();
var tableGrados;

document.addEventListener('DOMContentLoaded', function() {
    tableGrados = $('#tableGrados').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/grados/table_grados.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_grado"},
            {"data": "nombre_grado"},
            {"data": "est_reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });


    var formGrado = document.querySelector('#formGrado');
    if (formGrado) {
        formGrado.onsubmit = function(e) {
            console.log("Si entra al formulario.onsubmit");
            e.preventDefault();

            var idgrado = document.querySelector('#idgrado').value;
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
            var url = './models/grados/ajax-grados.php';
            var form = new FormData(formGrado);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalGrado').modal('hide');
                        formGrado.reset();
                        Swal.fire({
                            title: 'Grado',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableGrados.ajax.reload();
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
    }
});

function openModalGrado() {
    document.querySelector('#idgrado').value = "";
    document.querySelector('#modalTitulo').innerHTML = 'Nuevo Grado';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formGrado').reset();
    $("#modalGrado").modal('show');
}

function editarGrado(ID) {
    var idgrado = ID;
    console.log(idgrado);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Grado';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/grados/edit-grados.php?idgrado='+idgrado;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idgrado').value = data.data.id_grado;
                document.querySelector('#Nombre').value = data.data.nombre_grado;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalGrado").modal('show');

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

function eliminarGrado(ID){
    var idgrado = ID;

    Swal.fire({
        title: "Eliminar Grado",
        text: "¿Desea eliminar al Grado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/grados/delete-grados.php';
            request.open('POST', url, true);
            var strData = "idgrado="+idgrado;
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
                        tableGrados.ajax.reload();
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