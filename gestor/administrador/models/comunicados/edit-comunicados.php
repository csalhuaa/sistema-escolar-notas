<?php
require_once '../../../includes/conexion.php';

if (!empty($_GET['idcomunicado'])) {
    $idcomunicado = $_GET['idcomunicado'];

    $sql = "SELECT * FROM comunicados WHERE id_comunicado = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idcomunicado));

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Comunicado no encontrado');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
