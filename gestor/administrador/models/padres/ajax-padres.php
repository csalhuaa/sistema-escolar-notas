<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['Apellido_Paterno']) || empty($_POST['Apellido_Materno']) || empty($_POST['nombre_usuario']) || empty($_POST['tipo_usuario']) || empty($_POST['id_rol'])) {
        $respuesta = array(
            'status' => false, 
            'msg' => 'Todos los campos requeridos son necesarios',
            'idpadre' => $_POST['$idpadre']
        );
    } else {
        // Asigna las variables desde el formulario
        $idpadre = $_POST['idpadre'];
        $nombre = $_POST['Nombre'];
        $apellido_paterno = $_POST['Apellido_Paterno'];
        $apellido_materno = $_POST['Apellido_Materno'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $id_rol = $_POST['id_rol'];
        $info_contacto = $_POST['info_contacto'];
        $especialidad = !empty($_POST['especialidad']) ? $_POST['especialidad'] : null;
        $est = $_POST['est_reg'];

        // Encriptar la contraseña solo si se proporciona
        if (!empty($contraseña)) {
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        }

        // Verifica si el nombre de usuario o la combinación de nombre completo ya existen
        $sql = 'SELECT * FROM usuarios WHERE (nombre_usuario = ? OR (Nombre = ? AND Apellido_Paterno = ? AND Apellido_Materno = ?)) AND est_reg = "A"';
        $params = [$nombre_usuario, $nombre, $apellido_paterno, $apellido_materno];

        if (!empty($idpadre)) {
            $sql .= ' AND ID != ?';
            $params[] = $idpadre;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El nombre de usuario o la combinación de nombre completo ya existen',
                'idpadre' => $idpadre // Agregar el idusuario a la respuesta
            );
        } else {
            // Si $idusuario está vacío, estamos insertando un nuevo usuario
            if (empty($idpadre)) {
                $sqlInsert = 'INSERT INTO usuarios (Nombre, Apellido_Paterno, Apellido_Materno, nombre_usuario, contraseña, info_contacto, tipo_usuario, id_rol, especialidad, est_reg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $info_contacto, $tipo_usuario, $id_rol, $especialidad, $est));
                $accion = 1;
            } else {
                if (empty($contraseña)) {
                    $sqlUpdate = 'UPDATE usuarios SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, nombre_usuario = ?, info_contacto = ?, tipo_usuario = ?, id_rol = ?, especialidad = ?, est_reg = ? WHERE ID = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $info_contacto, $tipo_usuario, $id_rol, $especialidad, $est, $idpadre));
                    $accion = 2;
                } else {
                    $sqlUpdate = 'UPDATE usuarios SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, nombre_usuario = ?, contraseña = ?, info_contacto = ?, tipo_usuario = ?, id_rol = ?, especialidad = ?, est_reg = ? WHERE ID = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $info_contacto, $tipo_usuario, $id_rol, $especialidad, $est, $idpadre));
                    $accion = 3;
                }
            }

            if ($request) {
                if ($accion == 1) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Usuario creado correctamente',
                        'idpadre' => $idpadre // Agregar el idusuario a la respuesta
                    );
                } else if ($accion == 2 || $accion == 3) {
                    $respuesta = array(
                        'status' => true,
                        'msg' => 'Usuario actualizado correctamente',
                        'idpadre' => $idpadre // Agregar el idusuario a la respuesta
                    );
                }
            } else {
                $respuesta = array(
                    'status' => false,
                    'msg' => 'No se pudo ejecutar la operación',
                    'idpadre' => $idpadre // Agregar el idusuario a la respuesta
                );
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}
?>
