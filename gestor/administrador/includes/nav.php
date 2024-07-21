<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://img.freepik.com/vector-premium/icono-circulo-usuario-anonimo-ilustracion-vector-estilo-plano-sombra_520826-1931.jpg" alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?= $_SESSION['nombre_completo'] ?></p>
            <p class="app-sidebar__user-designation"><?= $_SESSION['nombre_rol'] ?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="listaUsuarios.php"><i class="app-menu__icon bi-people-fill"></i><span class="app-menu__label">Usuarios</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaProfesores.php"><i class="app-menu__icon bi bi-person"></i><span class="app-menu__label">Profesores</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaAlumnos.php"><i class="app-menu__icon bi bi-mortarboard-fill"></i><span class="app-menu__label">Alumnos</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaPadres.php"><i class="app-menu__icon bi bi-person-video"></i><span class="app-menu__label">Padres</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaGrados.php"><i class="app-menu__icon bi bi-123"></i><span class="app-menu__label">Grados</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaSecciones.php"><i class="app-menu__icon bi bi-alphabet-uppercase"></i><span class="app-menu__label">Secciones</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaCursos.php"><i class="app-menu__icon bi bi-book-fill"></i><span class="app-menu__label">Cursos</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaBimestres.php"><i class="app-menu__icon bi bi-calendar-week"></i><span class="app-menu__label">Bimestres</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaDocentesAulas.php"><i class="app-menu__icon bi bi-person-video3"></i><span class="app-menu__label">Docente Aula</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaMatriculas.php"><i class="app-menu__icon bi bi-pencil-square"></i><span class="app-menu__label">Matriculas</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaAulas.php"><i class="app-menu__icon bi bi-pencil-square"></i><span class="app-menu__label">Aulas</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="listaCompetencias.php"><i class="app-menu__icon bi bi-pencil-square"></i><span class="app-menu__label">Competencias</span></a>
        <li>
            <a class="app-menu__item" href="../logout.php"><i class="app-menu__icon bi bi-power"></i><span class="app-menu__label">Salir</span></a>
        </li>
    </ul>
</aside>