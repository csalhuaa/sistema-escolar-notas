<?php
require_once "../../../includes/conexion.php";

$sql = 'SELECT da.id_docente_aula, 
               CONCAT(u.nombre, " ", u.apellido_paterno, " ", u.apellido_materno) AS nombre_docente, 
               a.id_aula, 
               c.nombre AS nombre_curso
        FROM docente_aula da
        INNER JOIN usuarios u ON da.id_docente = u.id_usuario
        INNER JOIN cursos c ON da.id_curso = c.id_curso
        INNER JOIN aulas a ON da.id_aula = a.id_aula';

$query = $pdo->prepare($sql);
$query->execute();  

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($consulta); $i++) {
    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarDocenteAula('.$consulta[$i]['id_docente_aula'].')"><i class="fas fa-edit"></i>  Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarDocenteAula('.$consulta[$i]['id_docente_aula'].')"><i class="fas fa-trash-alt"></i>  Eliminar</button>
    ';
}

header('Content-Type: application/json');
echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>
