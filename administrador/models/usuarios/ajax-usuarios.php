<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['Apellido_Paterno']) || empty($_POST['Apellido_Materno']) || empty($_POST['nombre_usuario']) || empty($_POST['contraseña']) || empty($_POST['tipo_usuario']) || empty($_POST['id_rol'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos requeridos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $nombre = $_POST['Nombre'];
        $apellido_paterno = $_POST['Apellido_Paterno'];
        $apellido_materno = $_POST['Apellido_Materno'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $id_rol = $_POST['id_rol'];
        $info_contacto = !empty($_POST['info_contacto']) ? $_POST['info_contacto'] : null;
        $especialidad = !empty($_POST['especialidad']) ? $_POST['especialidad'] : null;

        // Encriptar la contraseña
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

        // Verifica si el usuario ya existe
        $sql = 'SELECT * FROM usuarios WHERE nombre_usuario = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre_usuario));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'El nombre de usuario ya existe');
        } else {
            // Inserta el nuevo usuario
            $sqlInsert = 'INSERT INTO usuarios (Nombre, Apellido_Paterno, Apellido_Materno, nombre_usuario, contraseña, tipo_usuario, id_rol, info_contacto, especialidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $queryInsert = $pdo->prepare($sqlInsert);
            $resultInsert = $queryInsert->execute(array($nombre, $apellido_paterno, $apellido_materno, $nombre_usuario, $contraseña, $tipo_usuario, $id_rol, $info_contacto, $especialidad));

            if ($resultInsert) {
                $respuesta = array('status' => true, 'msg' => 'Usuario creado correctamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al crear el usuario');
            }
        }
    }
    // Envía la respuesta en formato JSON
    echo json_encode($respuesta);
}
?>
