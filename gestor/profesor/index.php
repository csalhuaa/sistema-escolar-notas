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
?>

<main class="app-content">
    <div class="row">
        <div class="col-md-12 text-center border shadow p-2 bg-info text-white">
            <h3 class="display-4">SISTEMA ESCOLAR - SAN JOSE SCHOOL</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center border mt-3 p-4 bg-light">
           <h4>Mis Cursos</h4> 
        </div>
    </div>

    <div class="row">
        <?php if($result) { ?>
            <?php foreach($result as $curso) { ?>
                <div class="col-md-4 text-center border mt-3 p-4 bg-light">
                    <div class="card m2 shadow" style="width: 23rem;">
                        <img src="images/card.webp" class="card-img-top" alt="">
                        <div class="card-body">
                            <h4 class="card-title text-center"><?= $curso['nombre_curso'] ?></h4>
                            <p class="card-text"><?= $curso['descripcion'] ?></p>
                            <?php if(isset($curso['id_aula'])) { ?>
                                <h5 class="card-title">Aula: <kbd class="bg-info"><?= $curso['id_aula'] ?></kbd></h5>
                            <?php } ?>
                            <a href="notas.php?id=<?= $curso['id_curso'] ?>" class="btn btn-success">Notas</a>
                            <a href="alumnos.php?id_curso=<?= $curso['id_curso'] ?>&id_aula=<?= $curso['id_aula'] ?>" class="btn btn-warning">Alumnos</a>
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
