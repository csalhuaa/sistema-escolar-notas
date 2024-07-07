<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $idperiodo = $_POST['idperiodo'];
        $nombre = $_POST['Nombre'];
        $est_reg = $_POST['est_reg'];

        $sql = 'SELECT * FROM periodos WHERE nombre_periodo = ? AND est_reg = "A"';
        $params = [$nombre];

        if (!empty($idperiodo)) {
            $sql .= ' AND id_periodo != ?';
            $params[] = $idperiodo;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El nombre de periodo ya existe',
                'idperiodos' => $idperiodo
            );
        } else {
            // Crea una nueva sección
            if (empty($idperiodo)) {   
                $sqlInsert = 'INSERT INTO periodos (nombre_periodo, est_reg) VALUES (?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $est_reg));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE periodos SET nombre_periodo = ?, est_reg = ? WHERE id_periodo = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $est_reg, $idperiodo));
                $accion = 2;
            }

            if ($request) {
                $respuesta = array(
                    'status' => true,
                    'msg' => $accion == 1 ? 'Periodo creada correctamente' : 'Periodo actualizada correctamente'
                );
            } else {
                $respuesta = array(
                    'status' => false,
                    'msg' => 'No se pudo ejecutar la operación'
                );
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
