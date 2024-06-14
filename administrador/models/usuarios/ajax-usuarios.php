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

    if(!empty($_POST)) {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        if(empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['contraseña'])) {
            $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
        } else {
            $nombre = $_POST['nombre'];
            $apePat = $_POST['apePat'];
            $apeMat = $_POST['apeMat'];
            $usuario = $_POST['usuario'];
            $contraseña = $_POST['contraseña'];
            $contacto = $_POST['contacto'];
            $rol = $_POST['listRol']; 

            if ($resultInsert) {
                $respuesta = array('status' => true, 'msg' => 'Usuario creado correctamente');
            } else {
                $sqlInsert = 'INSERT INTO usuarios (nombre, apePat, apeMat, usuario, contraseña, contacto, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $resultInsert = $queryInsert->execute(array($nombre, $apePat, $apeMat, $usuario, $contraseña, $contacto, $rol));
                
                if($resultInsert) {
                    $respuesta = array('status' => true, 'msg' => 'Usuario creado correctamente');
                } else {
                    $respuesta = array('status' => false, 'msg' => 'Error al crear el usuario');
                }
            }
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
}
