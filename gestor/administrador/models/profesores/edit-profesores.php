<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idprofesor'])) {
    $idprofesor = $_GET['idprofesor'];

    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idprofesor));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Usuario no encontrado');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>