$(document).ready(function(){
    $('#loginAdmin').on('click', function(){
        loginAdmin();
    });
    $('#loginProfesor').on('click', function(){
        loginProfesor();
    });
    $('#loginPadre').on('click', function(){
        loginPadre();
    });
});

function loginAdmin(){
    var login = $('#usuario').val();
    var pass = $('#pass').val();

    $.ajax({
        url: './includes/loginAdmin.php',
        method: 'POST',
        data: {
            login: login,
            pass: pass,
        },
        success: function(data) {
            $('#messageAdmin').html(data);

            if(data.indexOf('Redirecting') >= 0){
                window.location = 'administrador/';
            }
        }
    });
}

function loginProfesor(){
    var loginProfesor = $('#usuarioProfesor').val();
    var passProfesor = $('#passProfesor').val();

    $.ajax({
        url: './includes/loginProfesor.php',
        method: 'POST',
        data: {
            login: loginProfesor,
            pass: passProfesor,
        },
        success: function(data) {
            $('#messageProfesor').html(data);

            if(data.indexOf('Redirecting') >= 0){
                window.location = 'profesor/';
            }
        }
    });
}

function loginPadre(){
    var loginPadre = $('#usuarioPadre').val();
    var passPadre = $('#passPadre').val();

    $.ajax({
        url: './includes/loginPadre.php',
        method: 'POST',
        data: {
            login: loginPadre,
            pass: passPadre,
        },
        success: function(data) {
            $('#messagePadre').html(data);

            if(data.indexOf('Redirecting') >= 0){
                window.location = 'padre/';
            }
        }
    });
}
