<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idmatricula'])) {
    $idmatricula = $_GET['idmatricula'];

    $sql = "SELECT * FROM matriculas WHERE id_matricula = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idmatricula));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Matricula no encontrada');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de Matricula no proporcionada');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>