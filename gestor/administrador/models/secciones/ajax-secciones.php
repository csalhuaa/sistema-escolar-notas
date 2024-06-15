<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['listGrado']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $idseccion = $_POST['idseccion'];
        $nombre = $_POST['Nombre'];
        $listGrados = $_POST['listGrado'];
        $est_reg = $_POST['est_reg'];

        if (empty($idseccion)) {      
            $sqlInsert = 'INSERT INTO secciones (nombre_seccion, id_grado, est_reg) VALUES (?, ?, ?)';
            $queryInsert = $pdo->prepare($sqlInsert);
            $request = $queryInsert->execute(array($nombre, $listGrados, $est_reg));
            $accion = 1;
        } else {
            // Actualiza la sección existente
            $sqlUpdate = 'UPDATE secciones SET nombre_seccion = ?, id_grado = ?, est_reg = ? WHERE ID = ?';
            $queryUpdate = $pdo->prepare($sqlUpdate);
            $request = $queryUpdate->execute(array($nombre, $listGrados, $est_reg, $idseccion));
            $accion = 2;
        }

        if ($request) {
            $respuesta = array(
                'status' => true,
                'msg' => $accion == 1 ? 'Sección creada correctamente' : 'Sección actualizada correctamente'
            );
        } else {
            $respuesta = array(
                'status' => false,
                'msg' => 'No se pudo ejecutar la operación'
            );
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
