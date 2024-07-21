<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Login - Sistema Escolar</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 900px;
            margin: 50px auto;
        }
        .login-form {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .logo-container {
            background-color: #f1f3f5;
            border-radius: 15px 0 0 15px;
        }
        .nav-tabs .nav-link {
            color: #495057;
        }
        .nav-tabs .nav-link.active {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center logo-container bg-white">
                <img src="logo.png" alt="logo school" class="img-fluid p-5">
            </div>
            <div class="col-lg-6 login-form p-5">
                <h1 class="text-center mb-4">Bienvenid@</h1>
                <ul class="nav nav-tabs nav-fill mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-tab-pane" type="button" role="tab" aria-selected="true">
                            <i class="fas fa-user-shield me-2"></i>Administrador
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="teacher-tab" data-bs-toggle="tab" data-bs-target="#teacher-tab-pane" type="button" role="tab" aria-selected="false">
                            <i class="fas fa-chalkboard-teacher me-2"></i>Profesor
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="parent-tab" data-bs-toggle="tab" data-bs-target="#parent-tab-pane" type="button" role="tab" aria-selected="false">
                            <i class="fas fa-user-friends me-2"></i>Padre
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="admin-tab-pane" role="tabpanel" aria-labelledby="admin-tab" tabindex="0">
                        <form action="" onsubmit="return validar()" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Nombre de usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="Contraseña" required>
                            </div>
                            <div id="messageAdmin" class="mb-3"></div>
                            <button id="loginAdmin" type="button" class="btn btn-primary w-100">INICIAR SESIÓN</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="teacher-tab-pane" role="tabpanel" aria-labelledby="teacher-tab" tabindex="0">
                        <form action="" onsubmit="return validar()" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="usuarioProfesor" class="form-label">Usuario</label>
                                <input type="text" name="usuarioProfesor" id="usuarioProfesor" class="form-control" placeholder="Nombre de usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="passwordProfesor" class="form-label">Contraseña</label>
                                <input type="password" name="passProfesor" id="passProfesor" class="form-control" placeholder="Contraseña" required>
                            </div>
                            <div id="messageProfesor" class="mb-3"></div>
                            <button id="loginProfesor" type="button" class="btn btn-primary w-100">INICIAR SESIÓN</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="parent-tab-pane" role="tabpanel" aria-labelledby="parent-tab" tabindex="0">
                        <form action="" onsubmit="return validar()" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="usuarioPadre" class="form-label">Usuario</label>
                                <input type="text" name="usuarioPadre" id="usuarioPadre" class="form-control" placeholder="Nombre de usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="passwordPadre" class="form-label">Contraseña</label>
                                <input type="password" name="passPadre" id="passPadre" class="form-control" placeholder="Contraseña" required>
                            </div>
                            <div id="messagePadre" class="mb-3"></div>
                            <button id="loginPadre" type="button" class="btn btn-primary w-100">INICIAR SESIÓN</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="../index.html" class="btn btn-link">
                        <i class="fas fa-home me-2"></i>Regresar al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/login.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
          'use strict'

          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.querySelectorAll('.needs-validation')

          // Loop over them and prevent submission
          Array.prototype.slice.call(forms)
            .forEach(function (form) {
              form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
                }

                form.classList.add('was-validated')
              }, false)
            })
        })()
    </script>
</body>
</html>