<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['descripcion']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $idcurso = $_POST['idcurso'];
        $nombre = $_POST['Nombre'];
        $descripcion = $_POST['descripcion'];
        $est_reg = $_POST['est_reg'];

        if (empty($idcurso)) {      
            $sqlInsert = 'INSERT INTO cursos (nombre, descripcion, est_reg) VALUES (?, ?, ?)';
            $queryInsert = $pdo->prepare($sqlInsert);
            $request = $queryInsert->execute(array($nombre, $descripcion, $est_reg));
            $accion = 1;
        } else {
            // Actualiza la sección existente
            $sqlUpdate = 'UPDATE cursos SET nombre = ?, descripcion = ?, est_reg = ? WHERE ID = ?';
            $queryUpdate = $pdo->prepare($sqlUpdate);
            $request = $queryUpdate->execute(array($nombre, $descripcion, $est_reg, $idcurso));
            $accion = 2;
        }

        if ($request) {
            $respuesta = array(
                'status' => true,
                'msg' => $accion == 1 ? 'Curso creado correctamente' : 'Curso actuaizado correctamente'
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
