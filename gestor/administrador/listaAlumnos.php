<?php
require_once 'includes/header.php';
require_once 'includes/modals/modal_alumno.php';
?>  
<!-- <script src="../js/jquery-3.7.0.min.js"></script> -->

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Lista de Alumnos</h1>
            <button class="btn btn-success" type="button" onclick="openModalAlumnos()">Nuevo Alumno</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de Alumnos</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableAlumnos">
                            <thead>
                                <tr>
                                    <th>ACCIONES</th>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>FECHA NACIMIENTO</th>
                                    <th>DIRECCIÓN</th>
                                    <th>TUTOR NOMBRE COMPLETO</th>
                                    <!-- <th>PADRE</th> -->
                                    <!-- <th>APELLIDO PATERNO</th>
                                    <th>APELLIDO MATERNO</th>
                                    <th>USUARIO</th>
                                    <th>CONTACTO</th>
                                    <th>ROL</th>
                                    <th>ID ROL</th>
                                    <th>ESPECIALIDAD</th> -->
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</main>

<?php
require_once 'includes/footer.php';
?>
