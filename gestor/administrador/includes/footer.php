</main>

<?php
// Include essential scripts
?>
<script src="../js/jquery-3.7.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<!-- The javascript plugin to display page loading on top -->
<script src="../js/plugins/pace.min.js"></script>
<script src="../js/plugins/fontawesome.js"></script>
<!-- Optional plugins -->
<script src="../js/plugins/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>

<?php
// Conditionally include page-specific scripts
$currentPage = basename($_SERVER['PHP_SELF']);
if ($currentPage === 'listaUsuarios.php') {
    echo '<script src="js/functionsUsuarios.js" defer></script>';
} elseif ($currentPage === 'listaProfesores.php') {
    echo '<script src="js/functionsProfesores.js" defer></script>';
} elseif ($currentPage === 'listaAlumnos.php') {
    echo '<script src="js/functionsAlumnos.js" defer></script>';
} elseif ($currentPage === 'listaPadres.php') {
    echo '<script src="js/functionsPadres.js" defer></script>';
} elseif ($currentPage === 'listaGrados.php') {
    echo '<script src="js/functionsGrados.js" defer></script>';
} elseif ($currentPage === 'listaSecciones.php') {
    echo '<script src="js/functionsSecciones.js" defer></script>';
} elseif ($currentPage === 'listaCursos.php') {
    echo '<script src="js/functionsCursos.js" defer></script>';
} elseif ($currentPage === 'listaBimestres.php') {
    echo '<script src="js/functionsBimestres.js" defer></script>';
} elseif ($currentPage === 'listaDocentesAulas.php') {
    echo '<script src="js/functionsDocentesAulas.js" defer></script>';
} elseif ($currentPage === 'listaMatriculas.php') {
    echo '<script src="js/functionsMatriculas.js" defer></script>';
} elseif ($currentPage === 'listaAulas.php') {
    echo '<script src="js/functionsAulas.js" defer></script>';
} elseif ($currentPage === 'listaCompetencias.php') {
    echo '<script src="js/functionsCompetencias.js" defer></script>';
} elseif ($currentPage === 'listaComunicados.php') {
    echo '<script src="js/functionsComunicados.js" defer></script>';
}
?>
</body>
</html>
