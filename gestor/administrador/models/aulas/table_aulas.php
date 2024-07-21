<?php
require_once "../../../includes/conexion.php";

    $sql = 'SELECT a.id_aula, a.est_reg, g.nombre_grado, s.nombre_seccion
            FROM aulas a
            INNER JOIN grados g ON a.id_grado = g.id_grado
            INNER JOIN secciones s ON a.id_seccion = s.id_seccion';

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
            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarAula('.$consulta[$i]['id_aula'].')"><i class="fas fa-edit"></i>  Editar</button>
            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarAula('.$consulta[$i]['id_aula'].')"><i class="fas fa-trash-alt">  Eliminar</i></button>
        ';
    }

    header('Content-Type: application/json');
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
?>