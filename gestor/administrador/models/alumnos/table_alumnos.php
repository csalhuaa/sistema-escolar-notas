<?php
require_once "../../../includes/conexion.php";

    $sql = '
    SELECT 
        e.id_estudiante, 
        e.nombre, 
        e.apellido_paterno, 
        e.apellido_materno, 
        e.fecha_nacimiento, 
        e.direccion, 
        CONCAT(u.Nombre, " ", u.Apellido_Paterno, " ", u.Apellido_Materno) AS tutor_nombre_completo, 
        e.est_reg
    FROM 
        estudiantes e
    JOIN 
        usuarios u ON e.id_tutor = u.id_usuario';

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
            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarAlumno('.$consulta[$i]['id_estudiante'].')"><i class="fas fa-edit"></i>  Editar</button> 
            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarAlumno('.$consulta[$i]['id_estudiante'].')"><i class="fas fa-trash-alt">  Eliminar</i></button>
        ';
    }

    header('Content-Type: application/json');
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>