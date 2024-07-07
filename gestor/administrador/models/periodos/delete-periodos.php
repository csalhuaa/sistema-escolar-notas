<?php

    require_once '../../../includes/conexion.php';

    if($_POST){
        $idperiodo = $_POST['idperiodo'];

        $sql = "UPDATE periodos SET est_reg = 'I' WHERE id_periodo = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idperiodo));

        if($result){
            $respuesta = array('status' => true, 'msg' => 'Periodo eliminada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar sección');
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>