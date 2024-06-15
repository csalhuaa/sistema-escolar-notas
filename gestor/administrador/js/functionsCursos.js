$("#tableCursos").DataTable();
var tableCursos;

document.addEventListener('DOMContentLoaded', function() {
    tableCursos = $('#tableCursos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/cursos/table_cursos.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "ID"},
            {"data": "nombre"},
            {"data": "descripcion"},
            {"data": "Est_Reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });


    var formCurso = document.querySelector('#formCurso');
    formCurso.onsubmit = function(e) {
        console.log("Si entra al formulario.onsubmit");
        e.preventDefault();

        var idcurso = document.querySelector('#idcurso').value;
        var nombre = document.querySelector('#Nombre').value;
        var descripcion = document.querySelector('#descripcion').value;
        var Est_Reg = document.querySelector('#est_reg').value;

        if (nombre == '' || descripcion == '' || Est_Reg == '') {
            Swal.fire({
                title: 'Atención',
                text: 'Todos los campos son necesarios',
                icon: 'error'
            });
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/cursos/ajax-cursos.php';
        var form = new FormData(formCurso);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (data.status) {
                    $('#modalCurso').modal('hide');
                    formCurso.reset();
                    Swal.fire({
                        title: 'Curso',
                        text: data.msg,
                        icon: 'success'
                    });
                    tableCursos.ajax.reload();
                } else {
                    Swal.fire({
                        title: 'Curso',
                        text: data.msg,
                        icon: 'error'
                    });
                }
            }
        }
    }
});

function openModalCurso() {
    document.querySelector('#idcurso').value = "";
    document.querySelector('#modalTitulo').innerHTML = 'Nuevo Curso';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formCurso').reset();
    $("#modalCurso").modal('show');
}

function editarCurso(ID) {
    var idcurso = ID;
    console.log(idcurso);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Curso';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/cursos/edit-cursos.php?idcurso='+idcurso;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idcurso').value = data.data.ID;
                document.querySelector('#Nombre').value = data.data.nombre_Curso;
                document.querySelector('#descripcion').value = data.data.descripcion;
                document.querySelector('#est_reg').value = data.data.Est_Reg;

                $("#modalCurso").modal('show');

            } else {
                Swal.fire({
                    title: 'Curso',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarCurso(ID){
    var idcurso = ID;

    Swal.fire({
        title: "Eliminar Curso",
        text: "¿Desea eliminar al Curso?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/cursos/delete-cursos.php';
            request.open('POST', url, true);
            var strData = "idcurso="+idcurso;
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
                        tableCursos.ajax.reload();
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