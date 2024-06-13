$("#alumnos").DataTable();

var tables;

document.addEventListener('DOMContentLoaded', function() {
    tables = $('#alumnos').DataTable({
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
            {"data": "ID"},
            {"data": "nombre"},
            {"data": "fecha_nacimiento"},
            {"data": "direccion"},
            {"data": "id_tutor"},
            // {"data": "nombre_usuario"},
            // {"data": "info_contacto"},
            // {"data": "tipo_usuario"},
            // {"data": "id_rol"},
            // {"data": "especialidad"},
            {"data": "Est_Reg"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });
});

var formAlumno = document.querySelector('#formAlumno');

formAlumno.onsubmit = function(e) {
    e.preventDefault();

    // var formProfesor = document.querySelector('#formProfesor');
    var idalumno = document.querySelector('#idalumno').value;
    var nombre = document.querySelector('#Nombre').value;
    // var apellido_paterno = document.querySelector('#Apellido_Paterno').value;
    // var apellido_materno = document.querySelector('#Apellido_Materno').value;
    // var nombre_usuario = document.querySelector('#nombre_usuario').value;
    // var contraseña = document.querySelector('#contraseña').value;
    // var tipo_usuario = document.querySelector('#tipo_usuario').value;
    // var id_rol = document.querySelector('#id_rol').value;
    // var info_contacto = document.querySelector('#info_contacto').value;
    // var especialidad = document.querySelector('#especialidad').value;
    var fecha_nacimiento = document.querySelector('#fecha_nacimiento').value;
    var direccion = document.querySelector('#direccion').value;
    var id_tutor = document.querySelector('#id_tutor').value;
    var Est_Reg = document.querySelector('#est_reg').value;

    if (nombre == '' || fecha_nacimiento == '' || id_tutor == '' || Est_Reg == '') {
        alert("Todos los campos deben llenarse")
        // swal("Atención", "Todos los campos son necesarios", "error");
        return false;
    }

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/profesores/ajax-profesores.php';
    var form = new FormData(formProfesor);
    request.open('POST', url, true);
    request.send(form);
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                $('#modalAlumno').modal('hide');
                formProfesor.reset();
                // swal('Profesor', data.msg, 'success');
                alert("Alumno Creado")
                tables.ajax.reload();
            } else {
                swal('Atención', data.msg, 'error');
            }
        }
    }
}

function openModal() {
    document.querySelector('#idalumno').value = ''
    document.querySelector('#modalTitulo').innerHTML = 'Nuevo Alumno'
    document.querySelector('#action').innerHTML = 'Guardar'
    document.querySelector('#formAlumno').reset();
    $("#modalAlumno").modal('show');
}

function editarProfesor(ID) {
    var idprofesor = ID;
    console.log(idprofesor);

    document.querySelector('#modalTitulo').innerHTML = 'Actualizar Profesor'
    document.querySelector('#action').innerHTML = 'Actualizar'

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/profesores/edit-profesores.php?idprofesor='+idprofesor;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText); 
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#idprofesor').value = data.data.ID;
                document.querySelector('#Nombre').value = data.data.Nombre;
                document.querySelector('#Apellido_Paterno').value = data.data.Apellido_Paterno;
                document.querySelector('#Apellido_Materno').value = data.data.Apellido_Materno;
                document.querySelector('#nombre_usuario').value = data.data.nombre_usuario;
                // document.querySelector('#tipo_usuario').value = data.data.tipo_usuario;
                document.querySelector('#info_contacto').value = data.data.info_contacto;
                document.querySelector('#especialidad').value = data.data.especialidad;
                // document.querySelector('#est_reg').value = data.data.Est_Reg;

                $("#modalProfesor").modal('show');

            } else {
                swal('Profesor', data.msg, 'error');
            }
        }
    }
}

function eliminarProfesor(ID){
    var idprofesor = ID;

    swal({
        title: "Eliminar Profesor",
        text: "¿Desea eliminar al Profesor?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancael: true,
    }, function(confirm){
        if(confirm){
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/profesores/delete-profesores.php';
            request.open('POST', url, true);
            var strData = "idprofesor="+idprofesor;
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);  // Add this line
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                        swal('Eliminar', data.msg, 'success');
                        tables.ajax.reload();
                    } else {
                        swal('Atención', data.msg, 'error');
                    }
                }
            }
        }
    })
}