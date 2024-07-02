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

<main class="app-content">
    <div class="row">
        <div class="col-md-12 text-center border shadow p-2 bg-info text-white">
            <h3 class="display-4">Notas de Estudiante</h3>
        </div>
    </div>
    <div class="row">
        <?php if ($result) { ?>
            <div class="col-md-12 text-center border mt-3 p-4 bg-light">
                <h4>Notas de <?= htmlspecialchars($idEstudiante) ?></h4>
                <table class="table table-bordered">
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
