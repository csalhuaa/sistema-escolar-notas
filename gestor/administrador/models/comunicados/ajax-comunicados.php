<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['titulo']) || empty($_POST['asunto']) || empty($_POST['fecha']) || empty($_POST['id_rol'])) {
        $respuesta = array(
            'status' => false,
            'msg' => 'Todos los campos requeridos son necesarios'
        );
    } else {
        // Asigna las variables desde el formulario
        $id_comunicado = $_POST['idcomunicado'];
        $titulo = $_POST['titulo'];
        $asunto = $_POST['asunto'];
        $fecha = $_POST['fecha'];
        $id_rol = $_POST['id_rol'];
        $est_reg = $_POST['est_reg'];

        // Verifica si un comunicado con el mismo título y asunto ya existe
        $sql = 'SELECT * FROM comunicados WHERE (titulo = ? AND asunto = ?) AND est_reg = "A"';
        $params = [$titulo, $asunto];

        if (!empty($id_comunicado)) {
            $sql .= ' AND id_comunicado != ?';
            $params[] = $id_comunicado;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El comunicado con el mismo título y asunto ya existe',
                'idcomunicado' => $id_comunicado // Agregar el id_comunicado a la respuesta
            );
        } else {
            // Si $id_comunicado está vacío, estamos insertando un nuevo comunicado
            if (empty($id_comunicado)) {
                $sqlInsert = 'INSERT INTO comunicados (titulo, asunto, fecha, id_rol, est_reg) VALUES (?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $paramsInsert = array($titulo, $asunto, $fecha, $id_rol, $est_reg);
                $request = $queryInsert->execute($paramsInsert);
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE comunicados SET titulo = ?, asunto = ?, fecha = ?, id_rol = ?, est_reg = ? WHERE id_comunicado = ?';
                $paramsUpdate = array($titulo, $asunto, $fecha, $id_rol, $est_reg, $id_comunicado);
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute($paramsUpdate);
                $accion = 2;
            }

            if ($request) {
                if ($accion == 1) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Comunicado creado correctamente',
                        'idcomunicado' => $pdo->lastInsertId() // Obteniendo el id_comunicado del nuevo registro
                    );
                } else if ($accion == 2) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Comunicado actualizado correctamente',
                        'idcomunicado' => $id_comunicado
                    );
                }
            } else {
                $respuesta = array(
                    'status' => false,
                    'msg' => 'No se pudo ejecutar la operación',
                    'idcomunicado' => $id_comunicado
                );
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
