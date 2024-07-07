<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idbimestre'])) {
    $idbimestre = $_GET['idbimestre'];

    $sql = "SELECT * FROM bimestre WHERE id_bimestre = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idbimestre));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Bimestre no encontrada');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de bimestre no proporcionada');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>