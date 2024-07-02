<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idEstudiante = $_GET['id_estudiante'];

// Query to fetch attendance records for the student
$sql = "
    SELECT fecha, presente as asistio
    FROM asistencia
    WHERE id_estudiante = ?
    ORDER BY fecha DESC
";

$query = $pdo->prepare($sql);
$query->execute([$idEstudiante]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="app-content">
    <div class="row">
        <div class="col-md-12 text-center border shadow p-2 bg-info text-white">
            <h3 class="display-4">Asistencia del Estudiante</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center border mt-3 p-4 bg-light">
           <h4>Asistencia</h4> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result) { ?>
                        <?php foreach ($result as $asistencia) { ?>
                            <tr>
                                <td><?= htmlspecialchars($asistencia['fecha']) ?></td>
                                <td class="text-center">
                                    <?php if ($asistencia['asistio']) { ?>
                                        <span>&#10003;</span> <!-- Checkmark -->
                                    <?php } else { ?>
                                        <span></span> <!-- Empty space -->
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="2" class="text-center">No se encontraron registros de asistencia.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
require_once 'includes/footer.php';
?>
