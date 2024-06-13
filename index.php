<?php
    session_start();
    if(isset($_SESSION['active'])){
        header('Location: administrador/');
    } else if(isset($_SESSION['activeP'])){
        header('Location: profesor/');
    } else if(isset($_SESSION['activePa'])){
        header('Location: padre/');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <header class="main-header">
        <div class="main-cont">
            <div class="desc-header">
                <!-- <img src="logo.png" alt="image school"> -->
                <!-- <p>School</p> -->
            </div>
        </div>   
        <div class="cont-header">
            <h1>Bienvenid@</h1>
            <div class="form">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Admin</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profesor</button>                  
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Padre</button>
                    </li>
                </ul>
                <div class="tab-content justify-content-center" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <form action="" method="POST" onsubmit="return validar()">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
                            <label for="password">Contraseña</label>
                            <input type="password" name="pass" id="pass" placeholder="Contraseña">
                            <div id="messageAdmin"></div>
                            <button id="loginAdmin" type="button">INICIAR SESION</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <form action="" method="POST" onsubmit="return validar()">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuarioProfesor" id="usuarioProfesor" placeholder="Nombre de usuario">
                            <label for="password">Contraseña</label>
                            <input type="password" name="passProfesor" id="passProfesor" placeholder="Contraseña">
                            <div id="messageProfesor"></div>
                            <button id="loginProfesor" type="button">INICIAR SESION</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <form action="" method="POST" onsubmit="return validar()">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuarioPadre" id="usuarioPadre" placeholder="Nombre de usuario">
                            <label for="password">Contraseña</label>
                            <input type="password" name="passPadre" id="passPadre" placeholder="Contraseña">
                            <div id="messagePadre"></div>
                            <button id="loginPadre" type="button">INICIAR SESION</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
        
    </header>

       
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script> -->
    <script src="js/plugins/sweetalert.min.js"> </script>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/login.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>