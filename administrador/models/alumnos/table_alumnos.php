<?php
require_once "../../../includes/conexion.php";

    $sql = 'SELECT * FROM estudiantes WHERE Est_Reg = "A"';
    $query = $pdo->prepare($sql);
    $query->execute();  

    $consulta = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($consulta); $i++) {
        if ($consulta[$i]['Est_Reg'] == 'A') {
                $consulta[$i]['Est_Reg'] = '<span class="badge badge-success bg-black">Activo</span>';
        } else {
            $consulta[$i]['Est_Reg'] = '<span class="badge badge-danger">Inactivo</span>';
        }

        $consulta[$i]['acciones'] = '
            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarAlumno('.$consulta[$i]['ID'].')"><i class="fas fa-edit"></i>Editar</button>
            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarAlumno('.$consulta[$i]['ID'].')"><i class="fas fa-trash-alt">Eliminar</i></button>
        ';
    }

    header('Content-Type: application/json');
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>
