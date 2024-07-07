$("#tablePeriodos").DataTable();
var tablePeriodos;

document.addEventListener('DOMContentLoaded', function() {
    tablePeriodos = $('#tablePeriodos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/periodos/table_periodos.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_periodo"},
            {"data": "nombre_periodo"},
            {"data": "est_reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });


    var formPeriodo = document.querySelector('#formPeriodo');
    if (formPeriodo) {
        formPeriodo.onsubmit = function(e) {
            console.log("Si entra al formulario.onsubmit");
            e.preventDefault();

            var idperiodo = document.querySelector('#idperiodo').value;
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
            var url = './models/periodos/ajax-periodos.php';
            var form = new FormData(formPeriodo);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalPeriodo').modal('hide');
                        formPeriodo.reset();
                        Swal.fire({
                            title: 'Periodo',
                            text: data.msg,
                            icon: 'success'
                        });
                        tablePeriodos.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Periodo',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalPeriodo() {
    document.querySelector('#idperiodo').value = "";
    document.querySelector('#modalTitulo').innerHTML = 'Nuevo Sección';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formPeriodo').reset();
    $("#modalPeriodo").modal('show');
}


function editarPeriodo(ID) {
    var idperiodo = ID;
    console.log(idperiodo);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Periodo';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/periodos/edit-periodos.php?idperiodo='+idperiodo;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idperiodo').value = data.data.id_periodo;
                document.querySelector('#Nombre').value = data.data.nombre_periodo;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalPeriodo").modal('show');

            } else {
                Swal.fire({
                    title: 'Periodo',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarPeriodo(ID){
    var idperiodo = ID;

    Swal.fire({
        title: "Eliminar Periodo",
        text: "¿Desea eliminar al Periodo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/periodos/delete-periodos.php';
            request.open('POST', url, true);
            var strData = "idperiodo="+idperiodo;
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
                        tablePeriodos.ajax.reload();
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