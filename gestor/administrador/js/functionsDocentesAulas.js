var tableDocentesAulas;

document.addEventListener('DOMContentLoaded', function() {
    tableDocentesAulas = $('#tableDocentesAulas').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/docentes-aulas/table_docentes_aulas.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "id_docente_aula"},
            {"data": "nombre_docente"},
            {"data": "id_aula"},
            {"data": "nombre_curso"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formDocenteAula = document.querySelector('#formDocenteAula');
    if (formDocenteAula) {
        formDocenteAula.onsubmit = function(e) {
            e.preventDefault();

            var id_docente = document.querySelector('#id_docente').value;
            var id_curso = document.querySelector('#id_curso').value;
            var id_aula = document.querySelector('#id_aula').value;

            if (id_docente == '' || id_curso == '' || id_aula == '') {
                Swal.fire({
                    title: 'Atención',
                    text: 'Todos los campos son necesarios',
                    icon: 'error'
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/docentes-aulas/ajax-docentes-aulas.php';
            var form = new FormData(formDocenteAula);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalDocenteAula').modal('hide');
                        formDocenteAula.reset();
                        Swal.fire({
                            title: 'Asignación',
                            text: data.msg,
                            icon: 'success'
                        });
                        tableDocentesAulas.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Asignación',
                            text: data.msg,
                            icon: 'error'
                        });
                    }
                }
            }
        }
    }
});

function openModalDocenteAula() {
    var id_docente = document.querySelector('#id_docente');
    var id_curso = document.querySelector('#id_curso');
    var id_aula = document.querySelector('#id_aula');
    var modalTitulo = document.querySelector('#modalTitulo');
    var action = document.querySelector('#action');
    var formDocenteAula = document.querySelector('#formDocenteAula');

    if (id_docente && id_curso && id_aula && modalTitulo && action && formDocenteAula) {
        id_docente.value = "";
        id_curso.value = "";
        id_aula.value = "";
        modalTitulo.innerHTML = 'Nueva Asignación';
        action.innerHTML = 'Guardar';
        formDocenteAula.reset();
        $("#modalDocenteAula").modal('show');
    } else {
        console.error('Alguno de los elementos no se encontró en el DOM.');
    }
}


function editarDocenteAula(ID) {
    var iddocenteaula = ID;

    console.log(iddocenteaula);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Asignación';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/docentes-aulas/edit-docentes-aulas.php?iddocenteaula=' + iddocenteaula;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#iddocenteaula').value = data.data.id_docente_aula;
                document.querySelector('#id_docente').value = data.data.id_docente;
                document.querySelector('#id_curso').value = data.data.id_curso;
                document.querySelector('#id_aula').value = data.data.id_aula;

                $("#modalDocenteAula").modal('show');
            } else {
                Swal.fire({
                    title: 'Asignación',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarDocenteAula(ID) {
    var iddocenteaula = ID;

    Swal.fire({
        title: "Eliminar Asignación",
        text: "¿Desea eliminar esta asignación?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/docentes-aulas/delete-docentes-aulas.php';
            request.open('POST', url, true);
            var strData = 'iddocenteaula=' + iddocenteaula;
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
                        tableDocentesAulas.ajax.reload();
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
    showDocentes();
    showCursos();
    showAulas();
}, false);

function showDocentes() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/optionsDocentes.php';

    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="' + valor.id_usuario + '">' + valor.nombre + ' ' +valor.apellido_paterno + ' ' + valor.apellido_materno + '</option>';
            });
            var id_docente = document.querySelector('#id_docente');
            if (id_docente) {
                id_docente.innerHTML = data;
            }
        }
    }
}

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

function showAulas() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/optionsAulas.php';

    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="' + valor.id_aula + '">' + valor.id_aula + '</option>';
            });
            var id_aula = document.querySelector('#id_aula');
            if (id_aula) {
                id_aula.innerHTML = data;
            }
        }
    }
}