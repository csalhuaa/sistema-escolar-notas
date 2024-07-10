<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['iddocenteaula'])) {
    $iddocenteaula = $_GET['iddocenteaula'];

    $sql = "SELECT * FROM docente_aula WHERE id_docente_aula = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($iddocenteaula));

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Docente Aula no encontrada');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de Docente Aula no proporcionada');
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>