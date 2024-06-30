<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

if (!empty($_GET['id_aula'])) {
    $id_aula = $_GET['id_aula'];
} else {
    header('Location: index.php');
    exit;
}

// Query to show students enrolled in the selected classroom
$sql = "SELECT id_estudiante, nombre, apellido_paterno, apellido_materno
        FROM estudiantes
        WHERE id_aula = ?";
    
$query = $pdo->prepare($sql);
$query->execute(array($id_aula));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Registro de Asistencia</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Registro de Asistencia</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form method="post" action="guardar_asistencia.php" id="asistenciaForm">
                        <input type="hidden" name="id_aula" value="<?= $id_aula ?>">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Presente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($result as $row) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_estudiante']) ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><?= htmlspecialchars($row['apellido_paterno']) ?></td>
                                    <td><?= htmlspecialchars($row['apellido_materno']) ?></td>
                                    <td>
                                        <input type="checkbox" name="asistencia[<?= $row['id_estudiante'] ?>]" value="1">
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once '../includes/footer.php';
?>

<script>
document.getElementById('asistenciaForm').addEventListener('submit', function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Guardar Asistencia',
        text: "¿Estás seguro de que deseas guardar esta Asistencia?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Guardado!", "", "success").then(() => {
                this.submit();
            });
        } else {
            Swal.fire("Cancelado!", "", "info");
        }
    });
});

<?php if (isset($_GET['status'])) { ?>
Swal.fire({
    title: <?= $_GET['status'] == 'success' ? "'¡Éxito!'" : "'¡Error!'" ?>,
    text: <?= $_GET['status'] == 'success' ? "'Asistencias guardadas correctamente.'" : "'Hubo un problema al guardar las asistencias.'" ?>,
    icon: <?= $_GET['status'] == 'success' ? "'success'" : "'error'" ?>,
    confirmButtonText: 'Aceptar'
});
<?php } ?>
</script>
