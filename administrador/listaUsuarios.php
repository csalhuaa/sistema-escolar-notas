<?php
require_once 'includes/header.php';
require_once 'includes/modals/modal.php';
?>  
<!-- <script src="../js/jquery-3.7.0.min.js"></script> -->

<<<<<<< HEAD
=======
<!-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"> -->
<script src="../js/plugins/jquery.dataTables.min.js"></script>
>>>>>>> refs/remotes/origin/main
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Usuarios</h1>
            <button class="btn btn-success" type="button" onclick="openModal()">Nuevo Usuario</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de Usuarios</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="usuarios">
                            <thead>
                                <tr>
                                    <th>ACCIONES</th>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO PATERNO</th>
                                    <th>APELLIDO MATERNO</th>
                                    <th>USUARIO</th>
<<<<<<< HEAD
                                    <th>CONTACTO</th>
                                    <th>ROL</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                        </tbody>
=======
                                    <th>TIPO USUARIO</th>
                                    <th>ID ROL</th>
                                    <th>CONTACTO</th>
                                    <th>ESPECIALIDAD</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
>>>>>>> refs/remotes/origin/main
                        </table>
                    </div>
                </div>
            </div>
        </div>
</main>

<?php
require_once 'includes/footer.php';
?>
