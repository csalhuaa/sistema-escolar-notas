<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

if (!empty($_GET['id_estudiante'])) {
    $id_estudiante = $_GET['id_estudiante'];
} else {
    header('Location: index.php');
    exit;
}

// Obtener los reportes del estudiante
$sql = "
SELECT 
    r.fecha,
    r.observaciones,
    c.nombre AS nombre_curso
FROM 
    reportes r
JOIN 
    cursos c ON r.id_curso = c.id_curso
WHERE 
    r.id_estudiante = ?
ORDER BY 
    r.fecha DESC
";
$query = $pdo->prepare($sql);
$query->execute([$id_estudiante]);
$reportes = $query->fetchAll(PDO::FETCH_ASSOC);

// Obtener detalles del estudiante
$sql_student = "SELECT nombre, apellido_paterno, apellido_materno FROM estudiantes WHERE id_estudiante = ?";
$query_student = $pdo->prepare($sql_student);
$query_student->execute([$id_estudiante]);
$student = $query_student->fetch(PDO::FETCH_ASSOC);
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
</style>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Reportes de <?= htmlspecialchars($student['nombre'] . ' ' . $student['apellido_paterno'] . ' ' . $student['apellido_materno']) ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Reportes</a></li>
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
                                    <th>Curso</th>
                                    <th>Fecha</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($reportes) > 0) { ?>
                                    <?php foreach ($reportes as $reporte) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($reporte['nombre_curso']) ?></td>
                                            <td><?= htmlspecialchars($reporte['fecha']) ?></td>
                                            <td><?= htmlspecialchars($reporte['observaciones']) ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No hay reportes para este estudiante en este curso.</td>
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

<?php require_once 'includes/footer.php'; ?>
