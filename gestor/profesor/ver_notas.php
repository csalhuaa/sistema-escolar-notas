<?php
ob_start(); // Start output buffering
require_once 'includes/header.php';
require_once '../includes/conexion.php';

if (!empty($_GET['id_estudiante']) && !empty($_GET['id_curso'])) {
    $idEstudiante = (int)$_GET['id_estudiante']; // Ensure it's an integer
    $idCurso = (int)$_GET['id_curso']; // Ensure it's an integer
} else {
    header('Location: index.php');
    exit;
}

// Get student's grades for the course
$sql = "
    SELECT c.descripcion AS competencia, b.nombre_bimestre AS bimestre, n.nota 
    FROM notas n
    JOIN competencia c ON n.id_competencia = c.id_competencia
    JOIN bimestre b ON n.id_bimestre = b.id_bimestre
    WHERE n.id_estudiante = :id_estudiante AND n.id_curso = :id_curso
    ORDER BY c.descripcion, b.nombre_bimestre
";

$query = $pdo->prepare($sql);
$query->execute([
    ':id_estudiante' => $idEstudiante,
    ':id_curso' => $idCurso
]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Get student's name
$sqlEstudiante = "
    SELECT nombre, apellido_paterno, apellido_materno 
    FROM estudiantes 
    WHERE id_estudiante = :id_estudiante
";

$queryEstudiante = $pdo->prepare($sqlEstudiante);
$queryEstudiante->execute([
    ':id_estudiante' => $idEstudiante
]);
$estudiante = $queryEstudiante->fetch(PDO::FETCH_ASSOC);

// Handle case where no records are found
if (!$estudiante) {
    echo "<p>No se encontró el estudiante especificado.</p>";
    require_once 'includes/footer.php';
    ob_end_flush();
    exit;
}
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Ver Notas</h1>
            <h4>Notas de <?= htmlspecialchars($estudiante['nombre']) ?> <?= htmlspecialchars($estudiante['apellido_paterno']) ?> <?= htmlspecialchars($estudiante['apellido_materno']) ?> para el Curso <?= htmlspecialchars($idCurso) ?></h4>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Ver Notas</a></li>
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
                                    <th>Competencia</th>
                                    <th>Bimestre</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result): ?>
                                    <?php foreach($result as $row): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['competencia']) ?></td>
                                            <td><?= htmlspecialchars($row['bimestre']) ?></td>
                                            <td><?= htmlspecialchars($row['nota']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No se encontraron notas para este curso.</td>
                                    </tr>
                                <?php endif; ?>
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
ob_end_flush(); // End output buffering and flush output
?>
