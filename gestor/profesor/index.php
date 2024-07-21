<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idprofesor = $_SESSION['id_usuario'];

// Query to fetch the courses assigned to the professor with their corresponding classroom
$sql = "SELECT c.id_curso, c.nombre AS nombre_curso, c.descripcion, 
               u.nombre AS nombre_profesor, u.apellido_paterno AS apellido_profesor,
               da.id_aula
        FROM Docente_Especialidades de
        INNER JOIN Cursos c ON de.id_curso = c.id_curso
        INNER JOIN Usuarios u ON de.id_docente = u.id_usuario
        LEFT JOIN docente_aula da ON de.id_docente = da.id_docente AND c.id_curso = da.id_curso
        WHERE de.id_docente = ?";

$query = $pdo->prepare($sql);
$query->execute(array($idprofesor));
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$sqlComunicadosVigentes = "SELECT c.id_comunicado, c.titulo, c.asunto, c.fecha, r.nombre_rol
        FROM comunicados c
        INNER JOIN roles r ON c.id_rol = r.id_rol
        WHERE c.id_rol = 2 AND c.fecha >= CURDATE()";

$queryComunicadosVigentes = $pdo->prepare($sqlComunicadosVigentes);
$queryComunicadosVigentes->execute();
$resultComunicadosVigentes = $queryComunicadosVigentes->fetchAll(PDO::FETCH_ASSOC);

// Query to fetch the past communications directed to the role
$sqlComunicadosPasados = "SELECT c.id_comunicado, c.titulo, c.asunto, c.fecha, r.nombre_rol
        FROM comunicados c
        INNER JOIN roles r ON c.id_rol = r.id_rol
        WHERE c.id_rol = 2 AND c.fecha < CURDATE()";

$queryComunicadosPasados = $pdo->prepare($sqlComunicadosPasados);
$queryComunicadosPasados->execute();
$resultComunicadosPasados = $queryComunicadosPasados->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .header-section {
        background-color: #020079;
        color: white;
    }
    .header-section h3 {
        margin: 0;
        padding: 1rem;
    }
    .title-section {
        background-color: #f8f9fa;
        padding: 1.5rem 0;
        margin-top: 1rem;
    }
    .card-custom {
        width: 23rem;
        margin-bottom: 1.5rem;
    }
    .card-custom img {
        height: 150px;
        object-fit: cover;
    }
    .card-custom .card-body {
        text-align: left;
    }
    .btn-custom {
        margin-top: 1rem;
    }
    .bg-info-light {
        background-color: #e0e0ff;
    }
</style>

<main class="app-content">
    <div class="row">
        <div class="col-md-12 text-center border mt-3 title-section">
           <h4>Mis Comunicados</h4> 
        </div>
    </div>
    <br>
    <div class="text-center">
        <button id="btnVigentes" class="btn btn-primary">Comunicados Vigentes</button>
        <button id="btnPasados" class="btn btn-secondary">Comunicados Pasados</button>
    </div>
    <br>
    <div id="comunicadosVigentes" class="row">
        <?php if ($resultComunicadosVigentes) { ?>
            <?php foreach ($resultComunicadosVigentes as $comunicado) { ?>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-custom border-light shadow">
                        <div class="card-body">
                            <h4 class="card-title"><?= htmlspecialchars($comunicado['titulo']) ?></h4><hr>
                            <p class="card-text"><?= htmlspecialchars($comunicado['asunto']) ?></p><hr>
                            <p class="card-text">Fecha del Evento: <?= htmlspecialchars($comunicado['fecha']) ?></p>
                            <p class="card-text">Destinatario: <?= htmlspecialchars($comunicado['nombre_rol']) ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <h4>No hay comunicados vigentes disponibles</h4>
            </div>
        <?php } ?>
    </div>
    <div id="comunicadosPasados" class="row" style="display: none;">
        <?php if ($resultComunicadosPasados) { ?>
            <?php foreach ($resultComunicadosPasados as $comunicado) { ?>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-custom border-light shadow">
                        <div class="card-body">
                            <h4 class="card-title"><?= htmlspecialchars($comunicado['titulo']) ?></h4><hr>
                            <p class="card-text"><?= htmlspecialchars($comunicado['asunto']) ?></p><hr>
                            <p class="card-text">Fecha del Evento: <?= htmlspecialchars($comunicado['fecha']) ?></p>
                            <p class="card-text">Destinatario: <?= htmlspecialchars($comunicado['nombre_rol']) ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <h4>No hay comunicados pasados disponibles</h4>
            </div>
        <?php } ?>
    </div>

    <div class="row">
        <div class="col-md-12 text-center border mt-3 title-section">
           <h4>Mis Cursos</h4> 
        </div>
    </div>
    <br>
    <div class="row">

        <?php if($result) { ?>
            <?php foreach($result as $curso) { ?>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-custom border-light shadow">
                        <img src="images/card.webp" class="card-img-top" alt="Curso">
                        <div class="card-body">
                            <h4 class="card-title text-center"><?= htmlspecialchars($curso['nombre_curso']) ?></h4>
                            <p class="card-text text-center"><?= htmlspecialchars($curso['descripcion']) ?></p>
                            <?php if(isset($curso['id_aula'])) { ?>
                                <h5 class="card-title text-center">Aula: <kbd class="bg-info"><?= htmlspecialchars($curso['id_aula']) ?></kbd></h5>
                            <?php } ?>
                            <div class="d-grid gap-2">
                                <a href="notas.php?id=<?= $curso['id_curso'] ?>" class="btn btn-success btn-custom">Notas</a>
                                <a href="alumnos.php?id_curso=<?= $curso['id_curso'] ?>&id_aula=<?= $curso['id_aula'] ?>" class="btn btn-warning btn-custom">Alumnos</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <h4>No hay cursos disponibles</h4>
            </div>
        <?php } ?>
    </div>
</main>

<?php
require_once 'includes/footer.php';
?>
<script>
    document.getElementById('btnVigentes').addEventListener('click', function() {
        document.getElementById('comunicadosVigentes').style.display = 'flex';
        document.getElementById('comunicadosPasados').style.display = 'none';
    });

    document.getElementById('btnPasados').addEventListener('click', function() {
        document.getElementById('comunicadosVigentes').style.display = 'none';
        document.getElementById('comunicadosPasados').style.display = 'flex';
    });
</script>



