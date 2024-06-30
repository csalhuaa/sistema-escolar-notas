<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idalumno'])) {
    $idalumno = $_GET['idalumno'];

    $sql = "SELECT * FROM estudiantes WHERE id_estudiante = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idalumno));

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