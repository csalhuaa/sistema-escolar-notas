<?php
require_once "../../../includes/conexion.php";

    $sql = "SELECT u.*, r.nombre_rol 
            FROM Usuarios u
            JOIN roles r ON u.id_rol = r.id_rol
            WHERE r.nombre_rol = 'Docente' ";

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
            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarProfesor('.$consulta[$i]['id_usuario'].')"><i class="fas fa-edit"></i>Editar</button>
            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarProfesor('.$consulta[$i]['id_usuario'].')"><i class="fas fa-trash-alt">Eliminar</i></button>
        ';
    }

    header('Content-Type: application/json');
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>
