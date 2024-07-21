<?php
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
?>

<!-- Sidebar menu -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="https://cdn-icons-png.flaticon.com/512/4656/4656822.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?= $_SESSION['nombre_completo'] ?></p>
            <p class="app-sidebar__user-designation"><?= $_SESSION['nombre_rol'] ?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon bi bi-house-door-fill"></i><span class="app-menu__label">Inicio</span></a></li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-person-standing"></i><span class="app-menu__label">Mis Hijos</span><i class="treeview-indicator bi bi-caret-down-fill"></i></a>
            <ul class="treeview-menu">
                <?php if($result) { ?>
                    <?php foreach($result as $hijo) { ?>
                        <li>
                            <a class="treeview-item" href="ver_notas.php?id_estudiante=<?= $hijo['id_estudiante'] ?>">
                                <i class="app-menu__icon bi bi-person"></i> <?= htmlspecialchars($hijo['nombre_estudiante'] . ' ' . $hijo['apellido_estudiante']) ?>
                                <span class="badge badge-info"><?= htmlspecialchars($hijo['nombre_grado'] . ' ' . $hijo['nombre_seccion']) ?></span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li><a class="treeview-item" href="#"><i class="app-menu__icon bi bi-person"></i> No hay hijos registrados</a></li>
                <?php } ?>
            </ul>
        </li>
        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon bi bi-power"></i><span class="app-menu__label">Salir</span></a></li>
    </ul>
</aside>
