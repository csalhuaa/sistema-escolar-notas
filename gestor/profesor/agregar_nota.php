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

// Get course name
$sql_curso = "SELECT nombre FROM cursos WHERE id_curso = ?";
$query_curso = $pdo->prepare($sql_curso);
$query_curso->execute([$id_curso]);
$curso = $query_curso->fetch(PDO::FETCH_ASSOC);

// Get student details
$sql_student = "SELECT nombre, apellido_paterno, apellido_materno FROM estudiantes WHERE id_estudiante = ?";
$query_student = $pdo->prepare($sql_student);
$query_student->execute([$id_estudiante]);
$student = $query_student->fetch(PDO::FETCH_ASSOC);

// Get competencies for the course
$sql_competencias = "SELECT id_competencia, descripcion FROM competencia WHERE id_curso = ?";
$query_competencias = $pdo->prepare($sql_competencias);
$query_competencias->execute([$id_curso]);
$competencias = $query_competencias->fetchAll(PDO::FETCH_ASSOC);

// Get bimesters
$sql_periodo = "SELECT id_periodo, nombre_periodo FROM periodos";
$query_periodo = $pdo->query($sql_periodo);
$periodos = $query_periodo->fetchAll(PDO::FETCH_ASSOC);
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
            <h1><i class="fa fa-dashboard"></i> Agregar Notas para el Curso <?= htmlspecialchars($curso['nombre']) ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Agregar Nota</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="guardar_nota.php" method="POST" id="notaForm">
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
                            <label for="id_periodo">Periodo</label>
                            <select class="form-control" id="id_periodo" name="id_periodo">
                                <?php foreach ($periodos as $periodo) { ?>
                                    <option value="<?= htmlspecialchars($periodo['id_periodo']) ?>"><?= htmlspecialchars($periodo['nombre_periodo']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <?php foreach ($competencias as $competencia) { ?>
                            <div class="form-group">
                                <label for="competencia<?= $competencia['id_competencia'] ?>"><?= htmlspecialchars($competencia['descripcion']) ?></label>
                                <input type="number" step="0.01" class="form-control" id="competencia<?= $competencia['id_competencia'] ?>" name="competencias[<?= $competencia['id_competencia'] ?>]" required>
                            </div>
                            <br>
                        <?php } ?>
                        <input type="hidden" name="id_estudiante" value="<?= htmlspecialchars($id_estudiante) ?>">
                        <input type="hidden" name="id_curso" value="<?= htmlspecialchars($id_curso) ?>">
                        <button type="submit" class="btn btn-primary">Guardar Notas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>

<script>
document.getElementById('notaForm').addEventListener('submit', function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Guardar Notas',
        text: "¿Estás seguro de que deseas guardar estas notas?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Guardado!", "", "success");
            timer: 5000;
            this.submit();
        } else {
            Swal.fire("Cancelado!", "", "info");
        }
    });
});
</script>
