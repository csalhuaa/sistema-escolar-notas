<?php

    require_once '../../../includes/conexion.php';

    if($_POST){
        $idusuario = $_POST['idusuario'];

        $sql = "UPDATE Usuarios SET est_reg = 'I' WHERE id_usuario = ?";
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idusuario));

        if($result){
            $respuesta = array('status' => true, 'msg' => 'Usuario eliminado correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al eliminar al usuario');
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>