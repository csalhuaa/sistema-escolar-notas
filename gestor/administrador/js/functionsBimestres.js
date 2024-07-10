$("#tableBimestres").DataTable();
var tableBimestres;

document.addEventListener('DOMContentLoaded', function() {
    tableBimestres = $('#tableBimestres').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/bimestres/table_bimestres.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_bimestre"},
            {"data": "nombre_bimestre"},
            {"data": "est_reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });


    var formBimestre = document.querySelector('#formBimestre');
    if (formBimestre) {
        formBimestre.onsubmit = function(e) {
            console.log("Si entra al formulario.onsubmit");
            e.preventDefault();

            var idbimestre = document.querySelector('#idbimestre').value;
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
            var url = './models/bimestres/ajax-bimestres.php';
            var form = new FormData(formBimestre);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalBimestre').modal('hide');
                        formBimestre.reset();
                        Swal.fire({
                            title: 'Bimestre',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableBimestres.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Bimestre',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalBimestre() {
    document.querySelector('#idbimestre').value = "";
    document.querySelector('#modalTitulo').innerHTML = 'Nuevo Bimestre';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formBimestre').reset();
    $("#modalBimestre").modal('show');
}


function editarBimestre(ID) {
    var idbimestre = ID;
    console.log(idbimestre);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Bimestre';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/bimestres/edit-bimestres.php?idbimestre='+idbimestre;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idbimestre').value = data.data.id_bimestre;
                document.querySelector('#Nombre').value = data.data.nombre_bimestre;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalBimestre").modal('show');

            } else {
                Swal.fire({
                    title: 'Bimestre',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarBimestre(ID){
    var idbimestre = ID;

    Swal.fire({
        title: "Eliminar Bimestre",
        text: "¿Desea eliminar el Bimestre?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/bimestres/delete-bimestres.php';
            request.open('POST', url, true);
            var strData = "idbimestre="+idbimestre;
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
                        tableBimestres.ajax.reload();
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