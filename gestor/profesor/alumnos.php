<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

if (!empty($_GET['id_aula'])) {
    $id_aula = $_GET['id_aula'];
} else {
    header('Location: index.php');
}

// Query to show students enrolled in the selected classroom
$sql = "SELECT id_estudiante, nombre, apellido_paterno, apellido_materno
        FROM estudiantes
        WHERE id_aula = ?";

$query = $pdo->prepare($sql);
$query->execute(array($id_aula));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Lista de Alumnos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de Alumnos</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($result as $row) { ?>
                                <tr>
                                    <td><?= $row['id_estudiante'] ?></td>
                                    <td><?= $row['nombre'] ?></td>
                                    <td><?= $row['apellido_paterno'] ?></td>
                                    <td><?= $row['apellido_materno'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once 'includes/footer.php';
?>
