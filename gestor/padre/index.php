<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

$idPadre = $_SESSION['id_usuario'];

// Query to fetch the children assigned to the parent
$sql = "
    SELECT e.id_estudiante, e.nombre AS nombre_estudiante, e.apellido_paterno AS apellido_estudiante, e.apellido_materno, 
           g.nombre_grado, s.nombre_seccion
    FROM estudiantes e
    INNER JOIN usuarios u ON e.id_tutor = u.id_usuario
    INNER JOIN aulas a ON e.id_aula = a.id_aula
    INNER JOIN grados g ON a.id_grado = g.id_grado
    INNER JOIN secciones s ON a.id_seccion = s.id_seccion
    WHERE u.id_rol = 3 AND u.id_usuario = ?
";

$query = $pdo->prepare($sql);
$query->execute([$idPadre]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);


$sqlComunicadosVigentes = "SELECT c.id_comunicado, c.titulo, c.asunto, c.fecha, r.nombre_rol
        FROM comunicados c
        INNER JOIN roles r ON c.id_rol = r.id_rol
        WHERE c.id_rol = 3 AND c.fecha >= CURDATE()";

$queryComunicadosVigentes = $pdo->prepare($sqlComunicadosVigentes);
$queryComunicadosVigentes->execute();
$resultComunicadosVigentes = $queryComunicadosVigentes->fetchAll(PDO::FETCH_ASSOC);

// Query to fetch the past communications directed to the role
$sqlComunicadosPasados = "SELECT c.id_comunicado, c.titulo, c.asunto, c.fecha, r.nombre_rol
        FROM comunicados c
        INNER JOIN roles r ON c.id_rol = r.id_rol
        WHERE c.id_rol = 3 AND c.fecha < CURDATE()";

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
        <div class="col-md-12 text-center border mt-3 p-4 bg-light">
           <h4>Mis Hijos</h4> 
        </div>
    </div>

    <div class="row">
        <?php if ($result) { ?>
            <?php foreach ($result as $estudiante) { ?>
                <div class="col-md-4 text-center mt-3 p-4">
                    <div class="card m2 shadow" style="width: 23rem;">
                        <img src="img/hijos.jpg" class="card-img-top" alt="">
                        <div class="card-body">
                            <h4 class="card-title text-center"><?= htmlspecialchars($estudiante['nombre_estudiante'] . ' ' . $estudiante['apellido_estudiante']) ?></h4>
                            <p class="card-text"><?= htmlspecialchars($estudiante['nombre_grado'] . ' - ' . $estudiante['nombre_seccion']) ?></p>
                            <a href="ver_asistencia.php?id_estudiante=<?= $estudiante['id_estudiante'] ?>" class="btn btn-warning">Asistencia</a>
                            <a href="ver_notas.php?id_estudiante=<?= $estudiante['id_estudiante'] ?>" class="btn btn-success">Notas</a>
                            <a href="ver_reportes.php?id_estudiante=<?= $estudiante['id_estudiante'] ?>" class="btn btn-info">Ver Reportes</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <h4>No se encontraron hijos registrados.</h4>
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