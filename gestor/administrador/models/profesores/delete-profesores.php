<?php

    require_once '../../../includes/conexion.php';

    if($_POST){
        $idprofesor = $_POST['idprofesor'];

        $sql = "UPDATE usuarios SET est_reg = 'I' WHERE id_usuario = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idprofesor));

        if($result){
            $respuesta = array('status' => true, 'msg' => 'Profesor eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar el profesor');
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>