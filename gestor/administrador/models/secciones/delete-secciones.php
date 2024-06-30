<?php

    require_once '../../../includes/conexion.php';

    if($_POST){
        $idseccion = $_POST['idseccion'];

        $sql = "UPDATE secciones SET est_reg = 'I' WHERE id_seccion = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idseccion));

        if($result){
            $respuesta = array('status' => true, 'msg' => 'Sección eliminada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar sección');
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>