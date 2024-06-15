<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idseccion'])) {
    $idseccion = $_GET['idseccion'];

    $sql = "SELECT * FROM secciones WHERE ID = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idseccion));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Sección no encontrada');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de sección no proporcionada');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>