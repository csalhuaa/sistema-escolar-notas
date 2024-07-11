<?php

    require_once '../../../includes/conexion.php';

    if($_POST){
        $idcompetencia = $_POST['idcompetencia'];

        $sql = "UPDATE competencia SET est_reg = 'I' WHERE id_competencia = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idcompetencia));

        if($result){
            $respuesta = array('status' => true, 'msg' => 'Competencia eliminada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar Competencia');
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>