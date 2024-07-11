<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idaula'])) {
    $idaula = $_GET['idaula'];

    $sql = "SELECT * FROM aulas WHERE id_aula = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idaula));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Aula no encontrada');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de Aula no proporcionada');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>