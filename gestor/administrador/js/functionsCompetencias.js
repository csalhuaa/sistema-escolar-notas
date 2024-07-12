$("#tableCompetencias").DataTable();
var tableCompetencias;

document.addEventListener('DOMContentLoaded', function() {
    tableCompetencias = $('#tableCompetencias').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/competencias/table_competencias.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_competencia"},
            {"data": "nombre"},
            {"data": "descripcion"},
            {"data": "est_reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });


    var formCompetencia = document.querySelector('#formCompetencia');
    if (formCompetencia) {
        formCompetencia.onsubmit = function(e) {
            e.preventDefault();

            var idcompetencia = document.querySelector('#idcompetencia').value;
            var id_curso = document.querySelector('#id_curso').value;
            var descripcion = document.querySelector('#descripcion').value;
            var est_reg = document.querySelector('#est_reg').value;

            if (id_curso == '' || descripcion == '' || est_reg == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios',
                    icon: 'error'
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/competencias/ajax-competencias.php';
            var form = new FormData(formCompetencia);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalCompetencia').modal('hide');
                        formCompetencia.reset();
                        Swal.fire({
                            title: 'Competencia',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableCompetencias.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Competencia',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalCompetencia() {
    document.querySelector('#idcompetencia').value = "";
    document.querySelector('#modalTitulo').innerHTML = 'Nueva Competencia';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formCompetencia').reset();
    $("#modalCompetencia").modal('show');
}

function editarCompetencia(ID) {
    var idcompetencia = ID;
    console.log(idcompetencia);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Competencia';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/competencias/edit-competencias.php?idcompetencia='+idcompetencia;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idcompetencia').value = data.data.id_competencia;
                document.querySelector('#id_curso').value = data.data.id_curso;
                document.querySelector('#descripcion').value = data.data.descripcion;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalCompetencia").modal('show');

            } else {
                Swal.fire({
                    title: 'Competencia',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarCompetencia(ID){
    var idcompetencia = ID;

    Swal.fire({
        title: "Eliminar Competencia",
        text: "¿Desea eliminar al Competencia?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/competencias/delete-competencias.php';
            request.open('POST', url, true);
            var strData = "idcompetencia="+idcompetencia;
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        Swal.fire({
                            title: 'Eliminar',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableCompetencias.ajax.reload();
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
            var id_curso = document.querySelector('#id_curso');
            if (id_curso) {
                id_curso.innerHTML = data;
            }
        }
    }
}