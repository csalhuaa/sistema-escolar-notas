<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos requeridos son necesarios');
    } else {
        // Asigna las variables desde el formulario
       //  $idalumno = !empty($_POST['idalumno']) ? $_POST['idalumno'] : 0;
        $idgrado = $_POST['idgrado'];
        $nombre = $_POST['Nombre'];
        $est_reg = $_POST['est_reg'];

        // Verifica si el usuario ya existe
        $sql = 'SELECT * FROM grados WHERE nombre_grado = ? AND ID != ? AND Est_Reg = "A"';
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre, $idgrado));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El nombre de grado ya existe',
                'idgrado' => $idgrado // Agregar el idusuario a la respuesta
            );
        } else {
            if ($idgrado == "") {      
                $sqlInsert = 'INSERT INTO grados (nombre_grado, est_reg) VALUES (?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $est_reg));
                $accion = 1;
            } else {
                // Actualiza el estudiante existente
                $sqlUpdate = 'UPDATE grados SET nombre_grado = ?, est_reg = ? WHERE ID = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $est_reg, $idgrado));
                $accion = 2;
            }

            if ($request) {
                if ($accion == 1) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Grado creado correctamente',
                        'idgrado' => $idgrado // Agregar el idusuario a la respuesta
                    );
                } else if ($accion == 2) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Grado actualizado correctamente',
                        'idgrado' => $idgrado // Agregar el idusuario a la respuesta
                    );
                }
            } else {
                $respuesta = array(
                    'status' => false,
                    'msg' => 'No se pudo ejecutar la operación',
                    'idgrado' => $idgrado // Agregar el idusuario a la respuesta
                );
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>