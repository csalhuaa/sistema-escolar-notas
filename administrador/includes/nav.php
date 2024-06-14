<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
<<<<<<< HEAD
            <p class="app-sidebar__user-name">
                <?= $_SESSION['nombre_usuario'] ?>
                 <!-- Administrador -->
            </p>
=======
            <p class="app-sidebar__user-name">John Doe</p>
>>>>>>> 1b3c3f534f844a8532a401a3bf81853f1b61d016
            <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="listaUsuarios.php"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Usuarios</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaProfesores.php"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Profesores</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaAlumnos.php"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Alumnos</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaPadres.php"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Padres</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Salir</span></a>
        </li>
    </ul>
</aside>