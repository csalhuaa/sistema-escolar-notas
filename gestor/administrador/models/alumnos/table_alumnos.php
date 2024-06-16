<?php
require_once "../../../includes/conexion.php";

    $sql = '
    SELECT 
        e.ID as estudiante_id, 
        e.nombre, 
        e.fecha_nacimiento, 
        e.direccion,
        CONCAT(u.Nombre, " ", u.Apellido_Paterno, " ", u.Apellido_Materno) as tutor_nombre_completo, 
        e.Est_Reg
    FROM 
        estudiantes e
    JOIN 
        usuarios u ON e.id_tutor = u.ID
    WHERE 
        e.Est_Reg = "A"';

    $query = $pdo->prepare($sql);
    $query->execute();  

    $consulta = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($consulta); $i++) {
        if ($consulta[$i]['Est_Reg'] == 'A') {
                $consulta[$i]['Est_Reg'] = '<span class="me-1 badge bg-success">Activo</span>';
        } else {
            $consulta[$i]['Est_Reg'] = '<span class="me-1 badge bg-danger">Inactivo</span>';
        }

        $consulta[$i]['acciones'] = '
            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarAlumno('.$consulta[$i]['estudiante_id'].')"><i class="fas fa-edit"></i>Editar</button>
            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarAlumno('.$consulta[$i]['estudiante_id'].')"><i class="fas fa-trash-alt">Eliminar</i></button>
        ';
    }

    header('Content-Type: application/json');
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>