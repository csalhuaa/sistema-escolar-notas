<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['fecha_nac']) || empty($_POST['direccion']) || empty($_POST['listpadre']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos requeridos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $idalumno = !empty($_POST['idalumno']) ? $_POST['idalumno'] : 0;
        $nombre = $_POST['Nombre'];
        $fecha_nacimiento = $_POST['fecha_nac'];
        $direccion = $_POST['direccion'];
        $id_tutor = $_POST['listpadre'];
        $est_reg = $_POST['est_reg'];

        if ($idalumno == 0) {
            // Inserta un nuevo estudiante
            $sqlInsert = 'INSERT INTO estudiantes (nombre, fecha_nacimiento, direccion, id_tutor, est_reg) VALUES (?, ?, ?, ?, ?)';
            $queryInsert = $pdo->prepare($sqlInsert);
            $request = $queryInsert->execute(array($nombre, $fecha_nacimiento, $direccion, $id_tutor, $est_reg));
            $accion = 1;
        } else {
            // Actualiza el estudiante existente
            $sqlUpdate = 'UPDATE estudiantes SET nombre = ?, fecha_nacimiento = ?, direccion = ?, id_tutor = ?, est_reg = ? WHERE ID = ?';
            $queryUpdate = $pdo->prepare($sqlUpdate);
            $request = $queryUpdate->execute(array($nombre, $fecha_nacimiento, $direccion, $id_tutor, $est_reg, $idalumno));
            $accion = 2;
        }

        if ($request) {
            if ($accion == 1) {
                $respuesta = array('status' => true, 'msg' => 'Alumno creado correctamente');
            } else {
                $respuesta = array('status' => true, 'msg' => 'Alumno actualizado correctamente');
            }
        } else {
            $respuesta = array('status' => false, 'msg' => 'No se pudo guardar la información');
        }
    }

    // Envía la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}
?>
