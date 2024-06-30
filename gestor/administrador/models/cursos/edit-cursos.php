<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];

    $sql = "SELECT * FROM cursos WHERE id_curso = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idcurso));

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