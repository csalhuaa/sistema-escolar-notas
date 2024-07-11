<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idcompetencia'])) {
    $idcompetencia = $_GET['idcompetencia'];

    $sql = "SELECT * FROM competencia WHERE id_competencia = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idcompetencia));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Competencia no encontrado');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de Competencia no proporcionado');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>