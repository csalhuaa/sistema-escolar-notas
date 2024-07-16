<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['fecha_nac']) || empty($_POST['direccion']) || empty($_POST['listpadre']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos requeridos son necesarios2');
    } else {
        $idalumno = $_POST['idalumno'];
        $nombre = $_POST['nombre'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $fecha_nacimiento = $_POST['fecha_nac'];
        $direccion = $_POST['direccion'];
        $id_tutor = $_POST['listpadre'];
        $est_reg = $_POST['est_reg'];

        // Verifica si el estudiante ya existe basado en nombre completo y tutor
        $sql = 'SELECT * FROM estudiantes WHERE nombre = ? AND apellido_paterno = ? AND apellido_materno = ? AND est_reg = "A"';
        $params = [$nombre, $apellido_paterno, $apellido_materno];

        if (!empty($idalumno)) {
            $sql .= ' AND id_estudiante != ?';
            $params[] = $idalumno;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El alumno ya existe',
                'idalumno' => $idalumno // Agregar el idusuario a la respuesta
            );
        } else {
            if (empty($idalumno)) {    
                $sqlInsert = 'INSERT INTO estudiantes (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, direccion, id_tutor, est_reg) VALUES (?, ?, ?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $direccion, $id_tutor, $est_reg));
                $accion = 1;
            } else {
                // Actualiza el estudiante existente
                $sqlUpdate = 'UPDATE estudiantes SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, fecha_nacimiento = ?, direccion = ?, id_tutor = ?, est_reg = ? WHERE id_estudiante = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $direccion, $id_tutor, $est_reg, $idalumno));
                $accion = 2;
            }

            if ($request) {
                if ($accion == 1) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Usuario creado correctamente',
                        'idalumno' => $idalumno // Agregar el idusuario a la respuesta
                    );
                } else if ($accion == 2) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Usuario actualizado correctamente',
                        'idalumno' => $idalumno // Agregar el idusuario a la respuesta
                    );
                }
            } else {
                $respuesta = array(
                    'status' => false,
                    'msg' => 'No se pudo ejecutar la operación',
                    'idalumno' => $idalumno // Agregar el idusuario a la respuesta
                );
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>