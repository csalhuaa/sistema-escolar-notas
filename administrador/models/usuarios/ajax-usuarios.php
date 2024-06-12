<?php

    require_once '../../../includes/conexion.php';

    if(!empty($_POST)) {
        if(empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['contraseña'])) {
            $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
        } else {
            $nombre = $_POST['nombre'];
            $usuaurio = $_POST['usuario'];
            $contraseña = $_POST['contraseña'];
            $rol = $_POST['listRol']; 

            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

            $sql = 'SELECT * FROM usuarios WHERE usuario = ?';
            $query = $pdo->prepare($sql);
            $query->execute(array($usuario));
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if($result > 0) {
                $respuesta = array('status' => false, 'msg' => 'El usuario ya existe');
            } else {
                $sqlInsert = 'INSERT INTO usuarios (nombre, usuario, contraseña, rol) VALUES (?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $resultInsert = $queryInsert->execute(array($nombre, $usuario, $contraseña, $rol));
                
                if($resultInsert) {
                    $respuesta = array('status' => true, 'msg' => 'Usuario creado correctamente');
                } else {
                    $respuesta = array('status' => false, 'msg' => 'Error al crear el usuario');
                }
            }
        }
    }