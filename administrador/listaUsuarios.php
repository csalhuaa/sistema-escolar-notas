<?php
require_once 'includes/header.php';
require_once 'includes/modals/modal.php';
?>  

<!-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"> -->
<script src="js/plugins/jquery.dataTables.min.js"></script>
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
                        <table class="table table-hover table-bordered" id="tableUsuarios">
                            <thead>
                                <tr>
                                    <th>ACCIONES</th>
                                    <th>ID</th>
                                    <th>USUARIO</th>
                                    <th>ROL</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr> 
                                    <th>
                                        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarUsuario(1)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarUsuario(1)"><i class="fas fa-trash-alt"></i></button>
                                    </th>
                                    <th>1</th>
                                    <th>admin</th>
                                    <th>Administrador</th>
                                    <th><span class="badge badge-success">Activo</span></th>
                                </tr>
                                <tr> 
                                    <th>
                                        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarUsuario(1)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarUsuario(1)"><i class="fas fa-trash-alt"></i></button>
                                    </th>
                                    <th>1</th>
                                    <th>admin</th>
                                    <th>Administrador</th>
                                    <th><span class="badge badge-success">Activo</span></th>
                                </tr>
                                <tr> 
                                    <th>
                                        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarUsuario(1)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarUsuario(1)"><i class="fas fa-trash-alt"></i></button>
                                    </th>
                                    <th>1</th>
                                    <th>admin</th>
                                    <th>Administrador</th>
                                    <th><span class="badge badge-success">Activo</span></th>
                                </tr>
                                <tr> 
                                    <th>
                                        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarUsuario(1)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarUsuario(1)"><i class="fas fa-trash-alt"></i></button>
                                    </th>
                                    <th>1</th>
                                    <th>admin</th>
                                    <th>Administrador</th>
                                    <th><span class="badge badge-success">Activo</span></th>
                                </tr>
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