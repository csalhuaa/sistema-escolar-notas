<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['apellido_paterno']) || empty($_POST['apellido_materno']) || empty($_POST['nombre_usuario']) || empty($_POST['id_rol'])) {
        $respuesta = array(
            'status' => false,
            'msg' => 'Todos los campos requeridos son necesarios'
        );
    } else {
        // Asigna las variables desde el formulario
        $id_usuario = $_POST['idusuario']; // Asegúrate de que este nombre coincide con el del formulario HTML
        $nombre = $_POST['nombre'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];
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

        // Si $id_usuario no es nulo, añade la condición de que el ID no debe coincidir
        if (!empty($id_usuario)) {
            $sql .= ' AND id_usuario != ?';
            $params[] = $id_usuario;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El nombre de usuario o la combinación de nombre completo ya existen'
            );
        } else {
            // Si $id_usuario está vacío, estamos insertando un nuevo usuario
            if (empty($id_usuario)) {
                $sqlInsert = 'INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, nombre_usuario, contraseña, numero_contacto, id_rol, info_contacto, est_reg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $numero_contacto, $id_rol, $info_contacto, $est_reg));
                $accion = 1;
            } else {
                // Si $id_usuario no está vacío, estamos actualizando un usuario existente
                if (empty($contraseña)) {
                    $sqlUpdate = 'UPDATE usuarios SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, nombre_usuario = ?, numero_contacto = ?, id_rol = ?, info_contacto = ?, est_reg = ? WHERE id_usuario = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $numero_contacto, $id_rol, $info_contacto, $est_reg, $id_usuario));
                    $accion = 2;
                } else {
                    $sqlUpdate = 'UPDATE usuarios SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, nombre_usuario = ?, contraseña = ?, numero_contacto = ?, id_rol = ?, info_contacto = ?, est_reg = ? WHERE id_usuario = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $numero_contacto, $id_rol, $info_contacto, $est_reg, $id_usuario));
                    $accion = 3;
                }
            }

            if ($request) {
                if ($accion == 1) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Usuario creado correctamente'
                    );
                } else if ($accion == 2 || $accion == 3) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Usuario actualizado correctamente'
                    );
                }
            } else {
                $respuesta = array(
                    'status' => false,
                    'msg' => 'No se pudo ejecutar la operación'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
?>
