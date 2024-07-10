<?php

    require_once '../../../includes/conexion.php';

    if($_POST){
        $idmatricula = $_POST['idmatricula'];

        $sql = "UPDATE matriculas SET est_reg = 'I' WHERE id_matricula = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idmatricula));

        if($result){
            $respuesta = array('status' => true, 'msg' => 'Matricula eliminada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar la Matricula');
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>