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
        <div class="col-md-12 text-center border mt-3 p-4" style="background-color: #f0f0f0;">
           <h4 style="color: #0200a3;">Asistencia</h4> 
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead style="background-color: #0200a3; color: #ffffff;">
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
                                        <span style="color: green;">&#10003;</span> <!-- Checkmark -->
                                    <?php } else { ?>
                                        <span style="color: red;">&#10007;</span> <!-- Cross -->
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
