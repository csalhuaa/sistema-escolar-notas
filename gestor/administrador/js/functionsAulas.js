var tableAulas;

document.addEventListener('DOMContentLoaded', function() {
    tableAulas = $('#tableAulas').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/aulas/table_aulas.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_aula"},
            {"data": "nombre_grado"},
            {"data": "nombre_seccion"},
            {"data": "est_reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });


    var formAula = document.querySelector('#formAula');
    if (formAula) {
        formAula.onsubmit = function(e) {
            console.log("Si entra al formulario.onsubmit");
            e.preventDefault();

            var idaula = document.querySelector('#idaula').value;
            var idgrado = document.querySelector('#id_grado').value;
            var idseccion = document.querySelector('#id_seccion').value;
            var est_reg = document.querySelector('#est_reg').value;

            if (idgrado == '' || idseccion == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios',
                    icon: 'error'
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/aulas/ajax-aulas.php';
            var form = new FormData(formAula);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalAula').modal('hide');
                        formAula.reset();
                        Swal.fire({
                            title: 'Aula',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableAulas.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Aula',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalAula() {
    document.querySelector('#idaula').value = "";
    document.querySelector('#modalTitulo').innerHTML = 'Nueva Aula';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAula').reset();
    $("#modalAula").modal('show');
}


function editarAula(ID) {
    var idaula = ID;
    console.log(idaula);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Aula';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/aulas/edit-aulas.php?idaula='+idaula;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idaula').value = data.data.id_aula;
                document.querySelector('#id_seccion').value = data.data.id_seccion;
                document.querySelector('#id_grado').value = data.data.id_grado;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalAula").modal('show');
            } else {
                Swal.fire({
                    title: 'Aula',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarAula(ID){
    var idaula = ID;

    Swal.fire({
        title: "Eliminar Aula",
        text: "¿Desea eliminar el Aula?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/aulas/delete-aulas.php';
            request.open('POST', url, true);
            var strData = "idaula="+idaula;
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
                        tableAulas.ajax.reload();
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

window.addEventListener('load', function() {
    showGrados();
    showSecciones();
}, false);

function showGrados() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/optionsGrados.php';

    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="' + valor.id_grado + '">' + valor.nombre_grado + '</option>';
            });
            var id_grado = document.querySelector('#id_grado');
            if (id_grado) {
                id_grado.innerHTML = data;
            }
        }
    }
}

function showSecciones() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/optionsSecciones.php';

    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="' + valor.id_seccion + '">' + valor.nombre_seccion + '</option>';
            });
            var id_seccion = document.querySelector('#id_seccion');
            if (id_seccion) {
                id_seccion.innerHTML = data;
            }
        }
    }
}