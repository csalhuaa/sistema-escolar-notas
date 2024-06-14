<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['Apellido_Paterno']) || empty($_POST['Apellido_Materno']) || empty($_POST['nombre_usuario']) || empty($_POST['tipo_usuario']) || empty($_POST['id_rol'])) {
        $respuesta = array(
            'status' => false, 
            'msg' => 'Todos los campos requeridos son necesarios',
            'idpadre' => $_POST['$idpadre']);
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
        $info_contacto = !empty($_POST['info_contacto']);
        $especialidad = !empty($_POST['especialidad']) ? $_POST['especialidad'] : null;

        // Encriptar la contraseña solo si se proporciona
        if (!empty($contraseña)) {
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        }

        // Verifica si el usuario ya existe
        $sql = 'SELECT * FROM usuarios WHERE nombre_usuario = ? AND ID != ? AND Est_Reg != "A"';
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre_usuario, $idpadre));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array(
                'status' => false, 
                'msg' => 'El nombre de usuario ya existe',
                'idpadre' => $_POST['$idpadre']
            );
        } else {
            // Inserta o actualiza el usuario
            if ($idpadre == "") {
                $sqlInsert = 'INSERT INTO usuarios (Nombre, Apellido_Paterno, Apellido_Materno, nombre_usuario, contraseña, tipo_usuario, id_rol, info_contacto, especialidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $tipo_usuario, $id_rol, $info_contacto, $especialidad));
                $accion = 1;
            } else {
                if (empty($contraseña)) {
                    $sqlUpdate = 'UPDATE usuarios SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, nombre_usuario = ?, tipo_usuario = ?, id_rol = ?, info_contacto = ?, especialidad = ? WHERE ID = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $tipo_usuario, $id_rol, $info_contacto, $especialidad, $idpadre));
                    $accion = 2;
                } else {
                    $sqlUpdate = 'UPDATE usuarios SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, nombre_usuario = ?, tipo_usuario = ?, id_rol = ?, info_contacto = ?, especialidad = ? WHERE ID = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $tipo_usuario, $id_rol, $info_contacto, $especialidad, $idpadre));
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