var tableMatriculas;

document.addEventListener('DOMContentLoaded', function() {
    tableMatriculas = $('#tableMatriculas').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/matriculas/table_matriculas.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_matricula"},
            {"data": "nombre_estudiante"},
            {"data": "nombre_grado"},
            {"data": "nombre_seccion"},
            {"data": "año"},
            {"data": "est_reg"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formMatricula = document.querySelector('#formMatricula');
    if (formMatricula) {
        formMatricula.onsubmit = function(e) {
            e.preventDefault();

            var id_estudiante = document.querySelector('#id_estudiante').value;
            var id_grado = document.querySelector('#id_grado').value;
            var id_seccion = document.querySelector('#id_seccion').value;
            var año = document.querySelector('#año').value;

            if (id_estudiante == '' || id_grado == '' || id_seccion == '' || año == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios',
                    icon: 'error'
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/matriculas/ajax-matriculas.php';
            var form = new FormData(formMatricula);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalMatricula').modal('hide');
                        formMatricula.reset();
                        Swal.fire({
                            title: 'Matrícula',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableMatriculas.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Matrícula',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalMatricula() {
    document.querySelector('#idmatricula').value = '';
    document.querySelector('#modalTitulo').innerHTML = 'Nueva Matrícula';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formMatricula').reset();
    $("#modalMatricula").modal('show');
}


function editarMatricula(ID) {
    var idmatricula = ID;

    console.log(idmatricula);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Matrícula';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/matriculas/edit-matriculas.php?idmatricula=' + idmatricula;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idmatricula').value = data.data.id_matricula;
                document.querySelector('#id_estudiante').value = data.data.id_estudiante;
                document.querySelector('#id_grado').value = data.data.id_grado;
                document.querySelector('#id_seccion').value = data.data.id_seccion;
                document.querySelector('#año').value = data.data.año;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalMatricula").modal('show');
            } else {
                Swal.fire({
                    title: 'Matrícula',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarMatricula(ID) {
    var idmatricula = ID;

    Swal.fire({
        title: "Eliminar Matrícula",
        text: "¿Desea eliminar esta matrícula?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/matriculas/delete-matriculas.php';
            request.open('POST', url, true);
            var strData = 'idmatricula=' + idmatricula;
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        Swal.fire({
                            title: 'Eliminar',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableMatriculas.ajax.reload();
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
    showEstudiantes();
    showGrados();
    showSecciones();
}, false);

function showEstudiantes() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/optionsEstudiantes.php';

    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="' + valor.id_estudiante + '">' + valor.nombre + ' ' +valor.apellido_paterno + ' ' + valor.apellido_materno + '</option>';
            });
            var id_estudiante = document.querySelector('#id_estudiante');
            if (id_estudiante) {
                id_estudiante.innerHTML = data;
            }
        }
    }
}

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