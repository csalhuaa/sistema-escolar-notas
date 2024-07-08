<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

if (!empty($_GET['id_estudiante']) && !empty($_GET['id_curso'])) {
    $id_estudiante = $_GET['id_estudiante'];
    $id_curso = $_GET['id_curso'];
} else {
    header('Location: notas.php');
    exit;
}

// Obtener el nombre del curso
$sql_curso = "SELECT nombre FROM cursos WHERE id_curso = ?";
$query_curso = $pdo->prepare($sql_curso);
$query_curso->execute([$id_curso]);
$curso = $query_curso->fetch(PDO::FETCH_ASSOC);

// Obtener detalles del estudiante
$sql_student = "SELECT nombre, apellido_paterno, apellido_materno FROM estudiantes WHERE id_estudiante = ?";
$query_student = $pdo->prepare($sql_student);
$query_student->execute([$id_estudiante]);
$student = $query_student->fetch(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
    .form-group label {
        font-weight: bold;
        color: #020079;
    }
    .form-control {
        border: 1px solid #020079;
    }
    .btn-primary {
        background-color: #020079;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Agregar Reporte para el Curso <?= htmlspecialchars($curso['nombre']) ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Agregar Reporte</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="guardar_reporte.php" method="POST" id="reporteForm">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" value="<?= htmlspecialchars($student['nombre']) ?>" disabled>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="apellido_paterno">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellido_paterno" value="<?= htmlspecialchars($student['apellido_paterno']) ?>" disabled>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="apellido_materno">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellido_materno" value="<?= htmlspecialchars($student['apellido_materno']) ?>" disabled>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="5" required></textarea>
                        </div>
                        <br>
                        <input type="hidden" name="id_estudiante" value="<?= htmlspecialchars($id_estudiante) ?>">
                        <input type="hidden" name="id_curso" value="<?= htmlspecialchars($id_curso) ?>">
                        <button type="submit" class="btn btn-primary">Guardar Reporte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>

<script>
document.getElementById('reporteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Guardar Reporte',
        text: "¿Estás seguro de que deseas guardar este reporte?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Guardado!", "", "success");
            this.submit();
        } else {
            Swal.fire("Cancelado!", "", "info");
        }
    });
});
</script>
