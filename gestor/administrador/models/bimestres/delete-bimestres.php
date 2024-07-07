<?php

    require_once '../../../includes/conexion.php';

    if($_POST){
        $idbimestre = $_POST['idbimestre'];

        $sql = "UPDATE bimestre SET est_reg = 'I' WHERE id_bimestre = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idbimestre));

        if($result){
            $respuesta = array('status' => true, 'msg' => 'Bimestre eliminada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar sección');
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>