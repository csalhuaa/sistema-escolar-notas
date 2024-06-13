<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idusuario'])) {
    $idusuario = $_GET['idusuario'];

    $sql = "SELECT * FROM usuarios WHERE ID = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idusuario));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Usuario no encontrado');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de usuario no proporcionado');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
