<?php

    require_once '../../../includes/conexion.php';

    if($_POST){
        $idalumno = $_POST['idalumno'];

        $sql = "UPDATE estudiantes SET Est_Reg = 'I' WHERE ID = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idalumno));

        if($result){
            $respuesta = array('status' => true, 'msg' => 'Estudiante eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar el estudiante');
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>