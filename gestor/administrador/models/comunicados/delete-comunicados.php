<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idcomunicado = $_POST['idcomunicado'];

    $sql = "UPDATE comunicados SET est_reg = 'I' WHERE id_comunicado = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idcomunicado));

    if ($result) {
        $respuesta = array('status' => true, 'msg' => 'Comunicado eliminado correctamente');
    } else {
        $respuesta = array('status' => false, 'msg' => 'Error al eliminar el comunicado');
    }
}
header('Content-Type: application/json');
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>
