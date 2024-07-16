<?php
require_once "../../../includes/conexion.php";

$sql = "SELECT c.*, r.nombre_rol 
        FROM comunicados c
        JOIN roles r ON c.id_rol = r.id_rol";

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
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarComunicado('.$consulta[$i]['id_comunicado'].')"><i class="fas fa-edit"></i>  Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarComunicado('.$consulta[$i]['id_comunicado'].')"><i class="fas fa-trash-alt">  Eliminar</i></button>
    ';
}

header('Content-Type: application/json');
echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>
