<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idgrado'])) {
    $idgrado = $_GET['idgrado'];

    $sql = "SELECT * FROM grados WHERE id_grado = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idgrado));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Grado no encontrado');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de Grado no proporcionado');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>