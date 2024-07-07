<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idperiodo'])) {
    $idperiodo = $_GET['idperiodo'];

    $sql = "SELECT * FROM periodos WHERE id_periodo = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idperiodo));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Periodo no encontrada');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de periodo no proporcionada');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>