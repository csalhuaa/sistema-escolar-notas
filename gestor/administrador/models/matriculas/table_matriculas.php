<?php
require_once "../../../includes/conexion.php";

$sql = 'SELECT m.id_matricula, CONCAT(e.nombre, " ", e.apellido_paterno, " ", e.apellido_materno) AS nombre_estudiante, 
               g.nombre_grado AS nombre_grado, 
               s.nombre_seccion AS nombre_seccion, 
               m.año, 
               m.est_reg
        FROM matriculas m
        INNER JOIN estudiantes e ON m.id_estudiante = e.id_estudiante
        INNER JOIN grados g ON m.id_grado = g.id_grado
        INNER JOIN secciones s ON m.id_seccion = s.id_seccion';


$query = $pdo->prepare($sql);
$query->execute();  

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($consulta); $i++) {
    if ($consulta[$i]['est_reg'] == 'A') {
            $consulta[$i]['est_reg'] = '<span class="me-1 badge bg-success">Activo</span>';
    } else {
        $consulta[$i]['est_reg'] = '<span class="me-1 badge bg-danger">Inactivo</span>';
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarMatricula('.$consulta[$i]['id_matricula'].')"><i class="fas fa-edit"></i>Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarMatricula('.$consulta[$i]['id_matricula'].')"><i class="fas fa-trash-alt">Eliminar</i></button>
    ';
}

header('Content-Type: application/json');
echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>
