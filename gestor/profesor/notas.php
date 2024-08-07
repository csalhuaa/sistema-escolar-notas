<?php
ob_start(); // Iniciar el buffer de salida
require_once 'includes/header.php';
require_once '../includes/conexion.php';

if (!empty($_GET['id'])) {
    $idcurso = $_GET['id'];
} else {
    header('Location: index.php');
    exit; // Asegúrate de detener la ejecución después de redirigir
}

$sql = "SELECT id_estudiante, nombre, apellido_paterno, apellido_materno FROM estudiantes";
$query = $pdo->query($sql);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .app-title h1 {
        color: #020079;
    }
    .app-title .breadcrumb-item a {
        color: #020079;
    }
    .tile {
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 10px;
    }
    .table thead th {
        background-color: #020079;
        color: white;
        text-align: center;
    }
    .table tbody tr:nth-child(odd) {
        background-color: #e0e0ff;
    }
    .table tbody tr:nth-child(even) {
        background-color: #f8f8ff;
    }
    .table tbody tr:hover {
        background-color: #c0c0ff;
    }
    .btn-success, .btn-primary, .btn-warning {
        margin-right: 0.5rem;
    }
</style>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Alumnos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de alumnos</a></li>
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
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($result as $row) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><?= htmlspecialchars($row['apellido_paterno']) ?></td>
                                    <td><?= htmlspecialchars($row['apellido_materno']) ?></td>
                                    <td class="text-center">
                                        <a href="agregar_nota.php?id_estudiante=<?= htmlspecialchars($row['id_estudiante']) ?>&id_curso=<?= htmlspecialchars($idcurso) ?>" class="btn btn-success">Agregar Nota</a>
                                        <a href="ver_notas.php?id_estudiante=<?= htmlspecialchars($row['id_estudiante']) ?>&id_curso=<?= htmlspecialchars($idcurso) ?>" class="btn btn-warning">Ver Notas</a>
                                        <a href="agregar_reporte.php?id_estudiante=<?= htmlspecialchars($row['id_estudiante']) ?>&id_curso=<?= htmlspecialchars($idcurso) ?>" class="btn btn-primary">Agregar Reporte</a>
                                        <a href="ver_reportes.php?id_estudiante=<?= htmlspecialchars($row['id_estudiante']) ?>&id_curso=<?= htmlspecialchars($idcurso) ?>" class="btn btn-warning">Ver Reportes</a>
                                    </td>
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
ob_end_flush(); 
?>
