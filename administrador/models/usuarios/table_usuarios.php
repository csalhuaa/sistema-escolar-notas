<?php
    require_once "../../../includes/conexion.php";

    $sql = 'SELECT * FROM Usuarios WHERE Usuario_EstReg = "A"';
    $query = $pdo->prepare($sql);
    $query->execute();  

    $consulta = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($consulta); $i++) {
        if ($consulta[$i]['Usuario_EstReg'] == 'A') {
            $consulta[$i]['Usuario_EstReg'] = '<span class="badge badge-success">Activo</span>';
        } else {
            $consulta[$i]['Usuario_EstReg'] = '<span class="badge badge-danger">Inactivo</span>';
        }

        $consulta[$i]['acciones'] = '
            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarUsuario('.$consulta[$i]['Usuario_Id'].')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarUsuario('.$consulta[$i]['Usuario_Id'].')"><i class="fas fa-trash-alt"></i></button>
        ';
    }

    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>
