<?php
require_once '../../../includes/conexion.php';

if ($_POST) {
    $iddocenteaula = $_POST['iddocenteaula'];

    $sql = "DELETE FROM docente_aula WHERE id_docente_aula = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($iddocenteaula));

    if ($result) {
        $respuesta = array('status' => true, 'msg' => 'Asignación docente aula eliminada correctamente');
    } else {
        $respuesta = array('status' => false, 'msg' => 'Error al eliminar asignación docente aula');
    }
} else {
    $respuesta = array('status' => false, 'msg' => 'No se recibieron datos POST');
}

header('Content-Type: application/json');
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>
