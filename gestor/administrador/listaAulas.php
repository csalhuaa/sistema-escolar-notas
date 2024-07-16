<?php
require_once 'includes/header.php';
require_once 'includes/modals/modal_aulas.php';
?> 

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Aulas</h1>
            <button class="btn btn-success" type="button" onclick="openModalAula()">Nueva Aula</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de Aulas</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableAulas">
                            <thead>
                                <tr>
                                    <th>ACCIONES</th>
                                    <th>ID</th>
                                    <th>GRADO</th>
                                    <th>SECCIÓN</th> 
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
