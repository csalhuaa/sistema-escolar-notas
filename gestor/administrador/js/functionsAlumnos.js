$("#tableAlumnos").DataTable();
var tableAlumnos;

document.addEventListener('DOMContentLoaded', function() {
    tableAlumnos = $('#tableAlumnos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "method": "POST",
            "url": "./models/alumnos/table_alumnos.php",
            "dataSrc": "",
        },
        "columns": [
            {"data": "acciones"},
            {"data": "estudiante_id"},
            {"data": "nombre"},
            {"data": "fecha_nacimiento"},
            {"data": "direccion"},
            {"data": "tutor_nombre_completo"},
            {"data": "Est_Reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formAlumno = document.querySelector('#formAlumno');
    formAlumno.onsubmit = function(e) {
        console.log("Si entra al formulario.onsubmit");
        e.preventDefault();

        // var formAlumno = document.querySelector('#formulario');
        var idalumno = document.querySelector('#idalumno').value;
        var nombre = document.querySelector('#Nombre').value;
        var fecha_nacimiento = document.querySelector('#fecha_nac').value;
        var direccion = document.querySelector('#direccion').value;
        var id_tutor = document.querySelector('#listpadre').value;
        var Est_Reg = document.querySelector('#est_reg').value;

        if (nombre == '' || fecha_nacimiento == '' || direccion == '' || id_tutor == '' || Est_Reg == '') {
            Swal.fire({
                title: 'Atención',
                text: 'Todos los campos son necesarios',
                icon: 'error'
            });
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumnos/ajax-alumnos.php';
        var formData = new FormData(formAlumno);
        request.open('POST', url, true);
        request.send(formData);

        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (data.status) {
                    $('#modalAlumno').modal('hide');
                    formAlumno.reset();
                    Swal.fire({
                        title: 'Alumno',
                        text: data.msg,
                        icon: 'success'
                    });
                    tableAlumnos.ajax.reload();
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
});

function openModalAlumnos() {
    document.querySelector('#idalumno').value = '';
    document.querySelector('#modalTitulo').innerHTML = 'Nuevo Alumno';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAlumno').reset();
    $("#modalAlumno").modal('show');
}

function editarAlumno(ID) {
    var idalumno = ID;

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Alumno';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/alumnos/edit-alumnos.php?idalumno=' + idalumno;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idalumno').value = data.data.ID;
                document.querySelector('#Nombre').value = data.data.nombre;
                document.querySelector('#fecha_nac').value = data.data.fecha_nacimiento;
                document.querySelector('#direccion').value = data.data.direccion;
                document.querySelector('#listpadre').value = data.data.id_tutor;
                document.querySelector('#est_reg').value = data.data.est_reg;

                $("#modalAlumno").modal('show');
            } else {
                Swal.fire({
                    title: 'Usuario',
                    text: data.msg,
                    icon: 'error'
                });
            }
        }
    }
}

function eliminarAlumno(ID){
    var idalumno = ID;

    Swal.fire({
        title: "Eliminar Alumno",
        text: "¿Desea eliminar al Alumno?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/alumnos/delete-alumnos.php';
            request.open('POST', url, true);
            var strData = "idalumno="+idalumno;
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
                        tableAlumnos.ajax.reload();
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

document.addEventListener('DOMContentLoaded', function() {
    // Función para cargar apoderados
    console.log("Si entra a la función cargarApoderados");
    function cargarApoderados() {
        fetch('./models/alumnos/get_apoderados.php')
            .then(response => response.json())
            .then(data => {
                let selectPadre = document.getElementById('listpadre');
                selectPadre.innerHTML = ''; // Limpiar las opciones existentes
                data.forEach(apoderado => {
                    let option = document.createElement('option');
                    option.value = apoderado.ID;
                    option.text = `${apoderado.Nombre} ${apoderado.Apellido_Paterno} ${apoderado.Apellido_Materno}`;
                    selectPadre.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Llamar a la función cuando se abre el modal
    let modal = document.getElementById('modalAlumno');
    modal.addEventListener('show.bs.modal', cargarApoderados);
});
