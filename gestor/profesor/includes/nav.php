<?php
require_once '../includes/conexion.php';

$idprofesor = $_SESSION['id_usuario'];

// Query to get courses assigned to the professor with corresponding classroom
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

<!-- Sidebar menu -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="https://cdn.icon-icons.com/icons2/343/PNG/512/Teachers_35749.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?= $_SESSION['nombre_completo'] ?></p>
            <p class="app-sidebar__user-designation"><?= $_SESSION['nombre_rol'] ?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon bi bi-house-door-fill"></i><span class="app-menu__label">Inicio</span></a></li>
        <li class="treeview">
            <a class="app-menu__item" href="index.php" data-toggle="treeview"><i class="app-menu__icon bi-book-fill"></i><span class="app-menu__label">Mis Cursos</span><i class="treeview-indicator bi bi-caret-down-fill"></i></a>
            <ul class="treeview-menu">
                <?php if($result) { ?>
                    <?php foreach($result as $curso) { ?>
                        <li>
                            <a class="treeview-item" href="notas.php?id=<?= $curso['id_curso'] ?>"
                                <i class="app-menu__icon bi bi-journal-bookmark-fill"></i> <?= $curso['nombre_curso'] ?>
                                <span class="badge badge-info"><?= $curso['id_aula'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li><a class="treeview-item" href="#"><i class="app-menu__icon bi bi-journal-bookmark-fill"></i> No hay cursos disponibles</a></li>
                <?php } ?>
            </ul>
        </li>
            <li>
            <a class="app-menu__item" href="asistencia.php?id_aula=<?= $curso['id_aula'] ?>">
                <i class="app-menu__icon bi bi-calendar-check-fill"></i>
                <span class="app-menu__label">Asistencia</span>
            </a>
        </li>

        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon bi bi-power"></i><span class="app-menu__label">Salir</span></a></li>
    </ul>
</aside>
