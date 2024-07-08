<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['apellido_paterno']) || empty($_POST['apellido_materno']) || empty($_POST['nombre_usuario']) || empty($_POST['tipo_usuario']) || empty($_POST['id_rol'])) {
        $respuesta = array(
            'status' => false,
            'msg' => 'Todos los campos requeridos son necesarios'
        );
    } else {
        // Asigna las variables desde el formulario
        $idprofesor = $_POST['idprofesor'];
        $nombre = $_POST['nombre'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $numero_contacto = !empty($_POST['numero_contacto']) ? $_POST['numero_contacto'] : null;
        $id_rol = $_POST['id_rol'];
        $info_contacto = !empty($_POST['info_contacto']) ? $_POST['info_contacto'] : null;
        $est_reg = $_POST['est_reg'];

        // Encriptar la contraseña solo si se proporciona
        if (!empty($contraseña)) {
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        }

        // Verifica si el nombre de usuario o la combinación de nombre completo ya existen
        $sql = 'SELECT * FROM usuarios WHERE (nombre_usuario = ? OR (nombre = ? AND apellido_paterno = ? AND apellido_materno = ?)) AND est_reg = "A"';
        $params = [$nombre_usuario, $nombre, $apellido_paterno, $apellido_materno];

        if (!empty($idprofesor)) {
            $sql .= ' AND id_usuario != ?';
            $params[] = $idprofesor;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El nombre de usuario o la combinación de nombre completo ya existen',
                'idprofesor' => $idprofesor // Agregar el idprofesor a la respuesta
            );
        } else {
            // Si $idprofesor está vacío, estamos insertando un nuevo profesor
            if (empty($idprofesor)) {
                $sqlInsert = 'INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, nombre_usuario, contraseña, tipo_usuario, numero_contacto, id_rol, info_contacto, est_reg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $paramsInsert = array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $tipo_usuario, $numero_contacto, $id_rol, $info_contacto, $est_reg);
                $request = $queryInsert->execute($paramsInsert);
                $accion = 1;
            } else {
                // Si la contraseña no está vacía, la actualizamos también
                if (!empty($contraseña)) {
                    $sqlUpdate = 'UPDATE usuarios SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, nombre_usuario = ?, contraseña = ?, tipo_usuario = ?, numero_contacto = ?, id_rol = ?, info_contacto = ?, est_reg = ? WHERE id_usuario = ?';
                    $paramsUpdate = array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $tipo_usuario, $numero_contacto, $id_rol, $info_contacto, $est_reg, $idprofesor);
                } else {
                    $sqlUpdate = 'UPDATE usuarios SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, nombre_usuario = ?, tipo_usuario = ?, numero_contacto = ?, id_rol = ?, info_contacto = ?, est_reg = ? WHERE id_usuario = ?';
                    $paramsUpdate = array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $tipo_usuario, $numero_contacto, $id_rol, $info_contacto, $est_reg, $idprofesor);
                }
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute($paramsUpdate);
                $accion = 2;
            }

            if ($request) {
                if ($accion == 1) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Usuario creado correctamente',
                        'idprofesor' => $pdo->lastInsertId() // Obteniendo el idprofesor del nuevo registro
                    );
                } else if ($accion == 2) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Usuario actualizado correctamente',
                        'idprofesor' => $idprofesor
                    );
                }
            } else {
                $respuesta = array(
                    'status' => false,
                    'msg' => 'No se pudo ejecutar la operación',
                    'idprofesor' => $idprofesor
                );
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
