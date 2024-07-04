<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idEstudiante = $_GET['id_estudiante'];

// Query to fetch the grades of the student
$sql = "
    SELECT n.nota, c.nombre AS nombre_curso, comp.descripcion AS descripcion_competencia, b.nombre_periodo
    FROM notas n
    INNER JOIN cursos c ON n.id_curso = c.id_curso
    INNER JOIN competencia comp ON n.id_competencia = comp.id_competencia
    INNER JOIN periodos b ON n.id_periodo = b.id_periodo
    WHERE n.id_estudiante = ? AND n.est_reg = 'A'
    ORDER BY c.nombre, comp.descripcion, b.id_periodo
";

$query = $pdo->prepare($sql);
$query->execute([$idEstudiante]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Organize data by course and competency
$grades = [];
foreach ($result as $row) {
    $course = $row['nombre_curso'];
    $competency = $row['descripcion_competencia'];
    $bimester = $row['nombre_periodo'];
    $grade = $row['nota'];
    
    if (!isset($grades[$course])) {
        $grades[$course] = [];
    }
    if (!isset($grades[$course][$competency])) {
        $grades[$course][$competency] = [];
    }
    $grades[$course][$competency][$bimester] = $grade;
}
?>

<style>
    /* styles.css */
body {
    background-color: #f8f9fa;
}

.main-header {
    background-color: #0200a3;
    color: #ffffff;
}

.section-header {
    background-color: #f0f0f0;
    color: #0200a3;
}

.table-responsive {
    margin-top: 20px;
}

.table thead th {
    background-color: #0200a3;
    color: #ffffff;
}

.table tbody td {
    vertical-align: middle;
}

.table tbody .checkmark {
    color: green;
}

.table tbody .cross {
    color: red;
}

</style>
<main class="app-content">
    <div class="row">
        <?php if ($result) { ?>
            <div class="col-md-12 text-center border mt-3 p-4 section-header">
                <h4>Notas de <?= htmlspecialchars($idEstudiante) ?></h4>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2">Curso</th>
                                <th rowspan="2">Competencia</th>
                                <th colspan="4">Bimestre</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grades as $course => $competencies) { ?>
                                <tr>
                                    <td rowspan="<?= count($competencies) + 1 ?>"><?= htmlspecialchars($course) ?></td>
                                </tr>
                                <?php foreach ($competencies as $competency => $bimesters) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($competency) ?></td>
                                        <td><?= htmlspecialchars($bimesters['Primer Bimestre'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($bimesters['Segundo Bimestre'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($bimesters['Tercer Bimestre'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($bimesters['Cuarto Bimestre'] ?? '') ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <h4>No se encontraron notas registradas.</h4>
            </div>
        <?php } ?>
    </div>
</main>

<?php
require_once 'includes/footer.php';
?>
