<?php
session_start();

// Verificar si el usuario ya está autenticado y redirigir
if (!empty($_SESSION['active'])) {
    header('Location: administrador/');
    exit(); // Asegurar que se detenga la ejecución aquí
} else if (!empty($_SESSION['activeP'])) {
    header('Location: profesor/');
    exit();
} else if (!empty($_SESSION['activePa'])) {
    header('Location: padre/');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>
<body class="d-flex align-items-center justify-content-center bg-light" style="height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                <img src="logo.png" alt="logo school" class="img-fluid">
            </div>
            <div class="col-lg-6 bg-white p-5 rounded-3 shadow">
                <h1 class="text-center mb-4">Bienvenid@</h1>
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Administrador</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profesor</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Padre</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <form action="" onsubmit="return validar()" class="p-4 rounded shadow-sm bg-white">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Nombre de usuario">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="Contraseña">
                            </div>
                            <div id="messageAdmin" class="mb-3"></div>
                            <button id="loginAdmin" type="button" class="btn btn-primary w-100">INICIAR SESIÓN</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <form action="" onsubmit="return validar()" class="p-4 rounded shadow-sm bg-white">
                            <div class="mb-3">
                                <label for="usuarioProfesor" class="form-label">Usuario</label>
                                <input type="text" name="usuarioProfesor" id="usuarioProfesor" class="form-control" placeholder="Nombre de usuario">
                            </div>
                            <div class="mb-3">
                                <label for="passwordProfesor" class="form-label">Contraseña</label>
                                <input type="password" name="passProfesor" id="passProfesor" class="form-control" placeholder="Contraseña">
                            </div>
                            <div id="messageProfesor" class="mb-3"></div>
                            <button id="loginProfesor" type="button" class="btn btn-primary w-100">INICIAR SESIÓN</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <form action="" onsubmit="return validar()" class="p-4 rounded shadow-sm bg-white">
                            <div class="mb-3">
                                <label for="usuarioPadre" class="form-label">Usuario</label>
                                <input type="text" name="usuarioPadre" id="usuarioPadre" class="form-control" placeholder="Nombre de usuario">
                            </div>
                            <div class="mb-3">
                                <label for="passwordPadre" class="form-label">Contraseña</label>
                                <input type="password" name="passPadre" id="passPadre" class="form-control" placeholder="Contraseña">
                            </div>
                            <div id="messagePadre" class="mb-3"></div>
                            <button id="loginPadre" type="button" class="btn btn-primary w-100">INICIAR SESIÓN</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="../index.html" class="btn btn-link">Regresar al inicio</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
